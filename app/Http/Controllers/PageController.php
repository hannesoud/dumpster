<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function pageSupport()
    {
        return view('pages/page_support');
    }

    public function pageTermsCondition()
    {
        return view('pages/page_terms_conditions');
    }

    public function pagePrivacyPolicy()
    {
        return view('pages/page_privacy_policy');
    }

}
