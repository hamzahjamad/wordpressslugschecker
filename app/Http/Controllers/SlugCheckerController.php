<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HamzahJamad\WordpressSlugChecker\SlugChecker;

class SlugCheckerController extends Controller
{

    public function check(Request $request)
    {
    	$this->validate($request, [
	        'blogger_id' => 'required',
	        'wordpress_url' => 'required',
	        'wordpress_fix' => 'required_with:wordpress_token',
	        'wordpress_token' => 'required_if:wordpress_fix,on'
	    ]);

    	$slugChecker = new SlugChecker($request->blogger_id, $request->wordpress_url, $request->wordpress_token);
    	return $slugChecker->getBloggerSlugs();
    }


    public function brokenSlug(Request $request)
    {
    	$slugChecker = new SlugChecker($request->blogger_id, $request->wordpress_url, $request->wordpress_token);
    	return $slugChecker->getBrokenSlugs(); 
    }

    public function fixSlug(Request $request)
    {
    	$slugChecker = new SlugChecker($request->blogger_id, $request->wordpress_url, $request->wordpress_token);
    	if ($request->wordpress_fix) {
    		return $slugChecker->run(); 
    	}
    }
}
