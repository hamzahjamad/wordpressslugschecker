<?php

namespace HamzahJamad\WordpressSlugChecker;

class Blogger
{
	public $id;

	function __construct($id)
	{
		$this->id = $id;
	}

	public function getPosts()
	{
		return $this->runCurl();
	}

	public function getSlugs()
	{
		$all = $this->runCurl();

		$urls = [];
		foreach ($all["entry"] as $entry) {
			$url = $entry['link'][2]["@attributes"]["href"];	
			$url = explode('/', $url);
			$end = end($url);
			$end = preg_replace('@\.html$@', "", $end);				
			$urls[] = $end;
		}
		
		return $urls;
	}

	private function runCurl()
	{
		// Get cURL resource
		$curl = curl_init();

		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL =>  "https://www.blogger.com/feeds/".$this->id."/posts/default?max-results=1000",
		));

		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

		// Send the request & save response to $resp
		$resp = curl_exec($curl);

		$info = curl_getinfo($curl);

		if ($info["http_code"] != 200) {
			throw new SlugCheckerException("Have trouble to connect with blogger.", 1);
		}

		// Close request to clear up some resources
		curl_close($curl);

		$xml = simplexml_load_string($resp, "SimpleXMLElement", LIBXML_NOCDATA);
		$json = json_encode($xml);
		return json_decode($json,TRUE);
	}
}