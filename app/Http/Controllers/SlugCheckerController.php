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
    	$blogger_slugs = $slugChecker->getBloggerSlugs();
    	$broken_slugs = $slugChecker->getBrokenSlugs();

    	$processed_slugs = [];

    	if ($request->wordpress_fix) {
    		$processed_slugs = $slugChecker->run();
    	}

    	return redirect('slugchecker')
    				->with('slugs', $blogger_slugs)
    				->with('broken_slugs' , $broken_slugs)
    				->with('processed_slugs' , $processed_slugs);
    }
}
