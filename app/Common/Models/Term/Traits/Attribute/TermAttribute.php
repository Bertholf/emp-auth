<?php

namespace App\Common\Models\Term\Traits\Attribute;

/**
 * Class TermAttribute
 * @package App\Common\Models\Term\Traits\Attribute
 */
trait TermAttribute
{

    /*
	 * Dictionary Card
	 */
    public function getText()
    {
        $pattern = '/\[{2}(.*?)\]{2}/is';

        preg_match_all($pattern, $this->text, $matches);

        $keywords = $matches[1];

        $text = $this->text;

        foreach ($keywords as $keyword) {
            $term = self::where('slug', $keyword)->first();

            if ($term) {
                $termText = str_replace('[[', '', $term->text);
                $termText = str_replace(']]', '', $termText);

                $text = str_replace("[[$keyword]]", "<a href='". route('app.term.show', $term->slug) ."' class='definition' data-toggle='popover' data-trigger='hover' title='$term->title' data-placement='bottom' data-content='$termText'>$keyword</a>", $text);
            } else {
                $text = str_replace("[[$keyword]]", $keyword, $text);
            }
        }

        return $text;
    }
}
