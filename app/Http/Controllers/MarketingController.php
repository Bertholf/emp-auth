<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Common\Libraries\Breadcrumbs;
use SEO;

class MarketingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return self
     */
    public function __construct()
    {
        // Set Base Breadcrumb
        Breadcrumbs::push('<i class="fa fa-home"></i>', route('marketing.index'));
    }

    /**
     * Show the marketing hompage.
     *
     * @return Response
     */
    public function index()
    {

        // Set Meta
        $meta = [
            'title' => 'You are Home Homey',
        ];

        // Set Breadcrumbs
        Breadcrumbs::push($meta['title'], route('marketing.index'));

        // Return View
        return view('common.marketing.index', compact('meta'));
    }
}
