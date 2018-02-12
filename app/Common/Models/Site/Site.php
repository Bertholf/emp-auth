<?php

namespace App\Common\Models\Site;

use App\Jobs\Harvest\Alexa;
use App\Jobs\Harvest\Basic;
use App\Jobs\Harvest\BBB;
use App\Jobs\Harvest\BuiltWith;
use App\Jobs\Harvest\Contacts;
use App\Jobs\Harvest\CrawlLinks;
use App\Jobs\Harvest\DNS;
use App\Jobs\Harvest\GoogleAdWords;
use App\Jobs\Harvest\GoogleAnalytics;
use App\Jobs\Harvest\GoogleLighthouse;
use App\Jobs\Harvest\GooglePageSpeed;
use App\Jobs\Harvest\GoogleSafebrowsing;
use App\Jobs\Harvest\GoogleSearchConsole;
use App\Jobs\Harvest\HtmlParser;
use App\Jobs\Harvest\Ip;
use App\Jobs\Harvest\Job;
use App\Jobs\Harvest\Moz;
use App\Jobs\Harvest\Pingdom;
use App\Jobs\Harvest\RobotsTxt;
use App\Jobs\Harvest\Screenshot;
use App\Jobs\Harvest\SSL;
use App\Jobs\Harvest\Sucuri;
use App\Jobs\Harvest\Trustpilot;
use App\Jobs\Harvest\W3C;
use App\Jobs\Harvest\Whois;
use App\Common\Models\Agency\Agency;
use App\Common\Models\Data\DataMetric;
use App\Common\Models\Data\DataRecommendation;
use App\Common\Models\Site\SiteRecommendation;
// TODO refactor into helper functions
use App\Repositories\Recommends\RetrieveValue;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Common\Models\Site\Traits\Relationship\SiteRelationship;

/**
 * @property Collection| SiteRecommendation[] recommendations
 * @property Collection| SiteMetric[]         metric
 */
class Site extends Model
{
    use Notifiable, SiteRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agency_id', 'team_id', 'slug', 'domain', 'url', 'ssl', 'email', 'affiliate_id', 'email_when_ready', 'source_url',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * @var Hashids
     */
    protected $hasher;

    /**
     * @param array $attributes
     * @throws \Hashids\HashidsException
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('emp-marketaing.sites_table');
        $this->hasher = new Hashids('DiyDifm Hash For Sites', 5);
    }

    /** RELATIONSHIPS     */

    public function scopeFindByHash($query, $hash)
    {
        $id = head($this->hasher->decode($hash));

        return $query->where('id', $id)->firstOrFail();
    }

    public function getHashIdAttribute()
    {
        if ($this->id) {
            return $this->hasher->encode($this->id);
        }
    }

    public function getCriticalRecommendationsCountAttribute()
    {
        return $this->filterRecommendationsByImpact($this->recommendations, 70)->count();
    }

    private function filterRecommendationsByImpact($recommendations, $min = null, $max = null)
    {
        if ($max) {
            $recommendations = $recommendations->filter(function ($recommendation) use ($max) {
                if ($recommendation->impact) {
                    if (is_array($recommendation->impact)) {
                        return max($recommendation->impact) < $max;
                    }

                    return $recommendation->impact < $max / 10;
                }

                return false;
            });
        }
        if ($min) {
            $recommendations = $recommendations->filter(function ($recommendation) use ($min) {
                if ($recommendation->impact) {
                    if (is_array($recommendation->impact)) {
                        return max($recommendation->impact) >= $min;
                    }

                    return $recommendation->impact >= $min / 10;
                }

                return false;
            });
        }

        return $recommendations;
    }

    public function getWarningRecommendationsCountAttribute()
    {
        return $this->filterRecommendationsByImpact($this->recommendations, 0, 70)->count();
    }

    public function getOpportunityRecommendationsCountAttribute()
    {
        return $this->filterRecommendationsByImpact($this->recommendations, 0.001, 30)->count();
    }

    public function getCriticalRecommendationsByType($type)
    {
        return $this->filterRecommendationsByImpactType($type, 70)->count();
    }

    private function filterRecommendationsByImpactType($type, $min = null, $max = null)
    {
        $recommendations = $this->recommendations->filter(function ($recommend) use ($type) {
            return is_array($recommend->impact) && array_has($recommend->impact, $type);
        });

        return $this->filterRecommendationsByImpact($recommendations, $min, $max);
    }

    public function getWarningRecommendationsByType($type)
    {
        return $this->filterRecommendationsByImpactType($type, 30, 70)->count();
    }

    public function getOpportunityRecommendationsByType($type)
    {
        return $this->filterRecommendationsByImpactType($type, 0.001, 30)->count();
    }

    public function getScoreAttribute()
    {
        return $this->scores->sortByDesc('created_at')->first(null, new SiteScore([
            'overall_score' => '0',
            'brand_score' => '0',
            'technical_score' => '0',
            'authority_score' => '0',
            'content_score' => '0',
            'experience_score' => '0',
            'community_score' => '0',
        ]));
    }

    public function getPreviousScoreAttribute()
    {
        $default = new SiteScore([
            'overall_score' => '0',
            'brand_score' => '0',
            'technical_score' => '0',
            'authority_score' => '0',
            'content_score' => '0',
            'experience_score' => '0',
            'community_score' => '0',
        ]);
        if ($this->scores->count()) {
            return $this->scores->sortByDesc('created_at')->take(2)->pop() ?: $default;
        }

        return $default;
    }

    public function getScoreChangeAttribute()
    {
        $change = new \stdClass();

        $change->overall_score = $this->previous_score->overall_score ? number_format(($this->score->overall_score - $this->previous_score->overall_score) / $this->previous_score->overall_score * 100, 2) : 0;
        $change->brand_score = $this->previous_score->brand_score ? number_format(($this->score->brand_score - $this->previous_score->brand_score) / $this->previous_score->brand_score * 100, 2) : 0;
        $change->technical_score = $this->previous_score->technical_score ? number_format(($this->score->technical_score - $this->previous_score->technical_score) / $this->previous_score->technical_score * 100, 2) : 0;
        $change->authority_score = $this->previous_score->authority_score ? number_format(($this->score->authority_score - $this->previous_score->authority_score) / $this->previous_score->authority_score * 100, 2) : 0;
        $change->content_score = $this->previous_score->content_score ? number_format(($this->score->content_score - $this->previous_score->content_score) / $this->previous_score->content_score * 100, 2) : 0;
        $change->experience_score = $this->previous_score->experience_score ? number_format(($this->score->experience_score - $this->previous_score->experience_score) / $this->previous_score->experience_score * 100, 2) : 0;
        $change->community_score = $this->previous_score->community_score ? number_format(($this->score->community_score - $this->previous_score->community_score) / $this->previous_score->community_score * 100, 2) : 0;
        $change->overall_confidence = $this->previous_score->overall_confidence ? number_format($this->score->overall_confidence - $this->previous_score->overall_confidence) : 0;
        $change->brand_confidence = $this->previous_score->brand_confidence ? number_format($this->score->brand_confidence - $this->previous_score->brand_confidence) : 0;
        $change->technical_confidence = $this->previous_score->technical_confidence ? number_format($this->score->technical_confidence - $this->previous_score->technical_confidence) : 0;
        $change->authority_confidence = $this->previous_score->authority_confidence ? number_format($this->score->authority_confidence - $this->previous_score->authority_confidence) : 0;
        $change->content_confidence = $this->previous_score->content_confidence ? number_format($this->score->content_confidence - $this->previous_score->content_confidence) : 0;
        $change->experience_confidence = $this->previous_score->experience_confidence ? number_format($this->score->experience_confidence - $this->previous_score->experience_confidence) : 0;
        $change->community_confidence = $this->previous_score->community_confidence ? number_format($this->score->community_confidence - $this->previous_score->community_confidence) : 0;

        return $change;
    }

    /**
     * Run a new audit for the site
     * @param array $data
     * @return SiteAuditLog|Model
     */
    public function runAudit(array $data)
    {
        $harvesters = [
            // Always run
            'basic' => Basic::class,

            // Services
            'alexa' => Alexa::class,
            // 'bbb' => BBB::class,
            'builtwith' => BuiltWith::class,
            'contacts' => Contacts::class,
            'dns' => DNS::class,
            // Ain't nobody got time for that --RS
            // 'crawllinks' => CrawlLinks::class,
            // 'google-adwords' => GoogleAdWords::class,
            // 'google-analytics' => GoogleAnalytics::class,
            'google-lighthouse' => GoogleLighthouse::class,
            // 'google-pagespeed' => GooglePageSpeed::class,
            'google-safebrowsing' => GoogleSafebrowsing::class,
            // 'google-searchconsole' => GoogleSearchConsole::class,
            'htmlparser' => HtmlParser::class,
            'ip' => Ip::class,
            'moz' => Moz::class,
            // 'pingdom' => Pingdom::class,
            'robotstxt' => RobotsTxt::class,
            'screenshot' => Screenshot::class,
            'ssl' => SSL::class,
            'sucuri' => Sucuri::class,
            // 'trustpilot' => Trustpilot::class,
            'w3c' => W3C::class,
            'whois' => Whois::class,
        ];

        if (in_array('all', $data['checks'])) {
            $data['checks'] = array_keys($harvesters);
        }

        $log = $this->audits()->create([
            'status' => 'scheduled',
            'auditor_type' => array_get($data, 'auditor_type'),
            'auditor_id' => array_get($data, 'auditor_id'),
        ]);

        //start harvesting the different audits
        collect($data['checks'])
            //Map harvester classes
            ->map(function ($metric) use ($harvesters) {
                return array_get($harvesters, strtolower($metric));
            })
            //Remove invalid/non-existant harvesters
            ->filter(function ($metric) {
                return !is_null($metric);
            })
            //Create queue jobs
            ->map(function ($harvester) use ($log) {
                return app()->makeWith($harvester, ['log' => $log]);
            })
            //dispath and log queue jobs
            ->each(function (Job $job) use ($log) {
                if (!$log->checks()->where('check', $job->getSlug())->count()) {
                    $log->checks()
                        ->create([
                            'check' => $job->getSlug(),
                            'title' => $job->getTitle(),
                            'status' => 'scheduled',
                        ]);
                    dispatch($job->onQueue('audits'));
                }
            });

        $log->fresh('checks');

        return $log;
    }

    /**
     * Site Audit logs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function audits()
    {
        return $this->hasMany(SiteAuditLog::class);
    }

    public function runRecommendations()
    {
        $this->recommendations()
              ->whereHas('type', function ($q) {
                  return $q->whereType(0);
              })
              ->delete();
        // SiteRecommendation::with('site')
        //                   ->with('type')
        //                   ->where('site_id', $this->id)
        //                   ->where('type', DataRecommendation::RECOM_COSTUM)
        //                   ->delete();

        // TODO: why only custom Recommendations?
        $drQuery = DataRecommendation::where('type', DataRecommendation::RECOM_COSTUM);

        // Check recommendation agency (either global or your agency)
        $agency = session('agency');

        if (!empty($agency)) {
            $drQuery->where('agency_id', $agency['id'])
                    ->orWhere('global', DataRecommendation::GLOBAL_ENABLED)
                    ->orWhereNull('agency_id');
        }

        $dataRecommendations = $drQuery->get();

        foreach ($dataRecommendations as $dataRecommendation) {
            $siteRecommendations = $this->getSiteRecommendations($dataRecommendation);


            if ($siteRecommendations !== false) {
                foreach ($siteRecommendations as $siteRecommendation) {
                    SiteRecommendation::create([
                      'recommendation_id' => $siteRecommendation['recommendation_id'],
                      'site_id' => $this->id,
                      'protocol_id' => $siteRecommendation['protocol_id'],
                      'service_id' => array_get($siteRecommendation, 'service.id'),
                      'service_count' => array_get($siteRecommendation, 'service.quantity'),
                      'text' => $siteRecommendation['text'],
                      'impact' => $siteRecommendation['impacts'],
                      'metrics' => $siteRecommendation['metric_ids'],
                    ]);
                }
            }
        }

        $this->scoreSite();
    }

    /**
     * @param $recommend
     * @return array|\Illuminate\Support\Collection
     */
    public function getSiteRecommendations(DataRecommendation $recommend)
    {
        $metrics = $this->metric()->groupBy('metric_id')->latest('created_at')->get()->keyBy('metric_id');

        $recommendations = collect($recommend->groups)
            ->filter(function ($group) use ($metrics) {
                $rules = collect(array_get($group, 'rules', []));
                $passed = $rules
                    ->map(function ($rule) use ($metrics) {
                        $type = 'getType' . studly_case(array_get($rule, 'type', 'value'));
                        $rule['expected'] = (new RetrieveValue)->{$type}($metrics, $rule, $this);
                        $metric = $metrics->get(array_get($rule, 'metric.id'));
                        $rule['actual'] = $metric ? $metric->value : 'N/A';

                        return $rule;
                    })
                    ->filter(function ($rule) {
                        if ($rule['expected'] === null || $rule['actual'] === 'N/A') {
                            return false;
                        }
                        // This matches Operator to Comparison Class
                        // $method = 'check_' . studly_case(array_get($rule, 'operator'));
                        // if (method_exists(Comparisons::class, $method)) {
                        //     return call_user_func([Comparisons::class, $method], $rule['actual'], $rule['expected']);
                        // }


                        $compFunction = 'check_' . snake_case(array_get($rule, 'operator'));
                        if (function_exists($compFunction)) {
                            return call_user_func($compFunction, $rule['actual'], $rule['expected']);
                        }

                        return false;
                    })
                    ->count();

                return array_get($group, 'match_type', 'any') === 'any' ? $passed : $passed === $rules->count();
            })
            ->map(function ($group) use ($recommend) {
                return [
                    'recommendation_id' => $recommend->id,
                    'metric_ids' => implode(',', array_pluck(array_get($group, 'rules'), 'metric.id')),
                    'protocol_id' => array_get($group, 'protocol.id'),
                    'text' => array_get($group, 'recommendation'),
                    'impacts' => collect(array_get($group, 'impacts'))->pluck('weight', 'slug')->toArray(),
                ];
            });

        if (!$recommendations->count() && $recommend->text_pass) {
            return collect([[
                'recommendation_id' => $recommend->id,
                'metric_ids' => [],
                'protocol_id' => null,
                'text' => $recommend->text_pass,
                'impacts' => [],
            ]]);
        }

        return $recommendations;
    }

    public function scoreSite()
    {
        $scores = $this->recommendations
            ->map(function ($recommendation) {
                if (is_array($recommendation->impact)) {
                    $impacts = array_merge([
                        'Brand' => 0,
                        'Technical' => 0,
                        'Authority' => 0,
                        'Content' => 0,
                        'Experience' => 0,
                        'Community' => 0,
                    ], $recommendation->impact);
                    $impacts['Overall'] = array_sum($impacts) / 7;

                    return $impacts;
                }
            })
            ->filter();
        $result = [
            'overall_score' => 100 - number_format($scores->average('Overall'), 2),
            'brand_score' => 100 - number_format($scores->average('Brand'), 2),
            'technical_score' => 100 - number_format($scores->average('Technical'), 2),
            'authority_score' => 100 - number_format($scores->average('Authority'), 2),
            'content_score' => 100 - number_format($scores->average('Content'), 2),
            'experience_score' => 100 - number_format($scores->average('Experience'), 2),
            'community_score' => 100 - number_format($scores->average('Community'), 2),
        ];

        $result = $this->calculateConfidenceLevels($result);
        $score = $this->scores()->firstOrNew([
            ['created_at', '>', Carbon::now()->format('Y-m-d 00:00:00')],
        ]);
        $score->fill($result);
        $score->save();

        return $score;
    }

    /**
     * @param $result
     * @return mixed
     */
    protected function calculateConfidenceLevels($result)
    {
        $result['overall_confidence'] = $this->metric()->groupBy('metric_id')->latest('created_at')->pluck('id')->count() / DataMetric::count() * 100;

        $result['technical_confidence'] = 0;
        $result['authority_confidence'] = 0;
        $result['content_confidence'] = 0;
        $result['experience_confidence'] = 0;
        $result['community_confidence'] = 0;

        $count['brand'] = ['required' => 0, 'available' => 0];
        $count['technical'] = ['required' => 0, 'available' => 0];
        $count['authority'] = ['required' => 0, 'available' => 0];
        $count['content'] = ['required' => 0, 'available' => 0];
        $count['experience'] = ['required' => 0, 'available' => 0];
        $count['community'] = ['required' => 0, 'available' => 0];

        // Run/Create Recommendations
        $query = DataRecommendation::where('type', 0);

        if ($agency = session('agency')) {
            $query->where(function ($q) use ($agency) {
                $q->where('agency_id', $agency['id'])
                    ->orWhere('global', 1)
                    ->orWhereNull('agency_id');
            });
        }
        $query->get()
            ->map(function ($recommendations) {
                $impacts = array_flatten(array_pluck($recommendations->groups, 'impacts.*.slug'));
                $relevant['impacts'] = array_unique($impacts);

                $rules = array_flatten(array_pluck($recommendations->groups, 'rules'), 1);
                $metrics = array_pluck($rules, 'metric.id');
                $relevant['metrics'] = array_unique($metrics);

                return $relevant;
            })
            ->map(function ($recommend) use (&$count) {
                $available = $this->metric()->groupBy('metric_id')->whereIn('metric_id', $recommend['metrics'])->count();
                foreach ($recommend['impacts'] as $impact) {
                    $count[ strtolower($impact) ]['required'] += count($recommend['metrics']);
                    $count[ strtolower($impact) ]['available'] += $available;
                }
            });

        foreach ($count as $impact => $stats) {
            $result[ $impact . '_confidence' ] = $stats['required'] === 0 ? 100 : $stats['available'] / $stats['required'] * 100;
        }

        return $result;
    }
}
