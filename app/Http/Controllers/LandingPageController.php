<?php

namespace App\Http\Controllers;

use App\Models\GuestReview;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function index(Request $request): View
    {
        $page = min(10000, max(1, $request->integer('reviews_page', 1)));

        return view('pages.landing', ['reviewFeed' => GuestReview::reviewFeed('all', $page)]);
    }
}
