<?php

namespace HamzahJamad\WordpressSlugChecker;

/**
* 
*/
class Wordpress
{
	public $url;
	public $token;

	function __construct($url, $token)
	{
		$this->url = $url;
		$this->token = $token;
	}

	public function checkSlug($slug)
	{
		$data = ['slug' => $slug];
		return !empty( $this->runCurl('posts' , $data) ); //return true if exist
	}

	public function getSlugs()
	{
		$posts = $this->getPosts();
		$slugs = [];

		foreach ($posts as $post) {
			$slugs[] = $post['slug'];
		}
		return $slugs;
	}

	public function setSlug($old_slug, $new_slug)
	{
		if (!$this->checkSlug($old_slug)) {
			throw new SlugCheckerException("slug_not_exist", 1);
		}

		$post = $this->runCurl('posts', ['slug' => $old_slug]);
		$data = $this->runCurl('posts/'.$post[0]['id'], ['slug' => $new_slug] , 'post');

		if (!isset($data['slug'])) {
			throw new SlugCheckerException($data['code'], 1);
		}

		return $data['slug'];
	}

	public function getPosts()
	{
		$page = 1;
		$posts = [];

		while (!empty($list = $this->runCurl('posts', [ 'per_page'=> 100 , 'page' => $page ]))) {
			$posts = array_merge($posts, $list);
			$page++;
		}
		 return $posts; 
	}

	private function runCurl($endpoint , $data=null, $method = 'get')
	{
		$url = "http://".$this->url."/wp-json/wp/v2/".$endpoint;

		// Get cURL resource
		$curl = curl_init();

		$get_query = '';

		if ($method == 'get') {
			$is_first = true;
			foreach ($data as $key => $value) {
				if ($is_first) {
					$get_query .= '?'.$key.'='.$value;
				} else {
					$get_query .= '&'.$key.'='.$value;
				}
				$is_first = false;
			}
			$query = [
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => $url.$get_query,
			];

			curl_setopt_array($curl, $query);
		}


		if ($method == 'post') {

			$fields_string = '';

			foreach($data as $key=>$value) { 
				$fields_string .= $key.'='.$value.'&'; 
			}

			rtrim($fields_string, '&');

			curl_setopt($curl,CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl,CURLOPT_POST, count($data));
			curl_setopt($curl,CURLOPT_POSTFIELDS, $fields_string);

			$post_field = [
						CURLOPT_POST => 1,
					    CURLOPT_POSTFIELDS => $data
			];
		}

	
		$headers = [
		    "Authorization:Basic ".$this->token
		];

		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		// Send the request & save response to $resp
		$resp = curl_exec($curl);

		$info = curl_getinfo($curl);

		if ($info["http_code"] != 200) {
			throw new SlugCheckerException("Have trouble to connect with your website.", 1);
		}

		// Close request to clear up some resources
		curl_close($curl);

		return json_decode($resp , true);
	}


}