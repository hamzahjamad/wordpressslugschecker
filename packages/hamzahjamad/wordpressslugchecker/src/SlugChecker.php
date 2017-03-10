<?php

namespace HamzahJamad\WordpressSlugChecker;

class SlugChecker
{
	private $blogger;
	private $wordpress;

	function __construct($blogger_id, $wordpress_url, $wordpress_token)
	{
		$this->blogger = new Blogger($blogger_id);
		$this->wordpress = new Wordpress($wordpress_url , $wordpress_token);
	}

	/**
	 * this will be try to fix the Slug on wordpress
	 * @return array list of the slug that fixed and not fixed
	 */
	public function run()
	{
		return $this->processSlug($this->getBrokenSlugs() , $this->getWordpressSlugs());
	}

	/**
	 * get slugs from blogger
	 * @return array list of slugs from blogger
	 */
	public function getBloggerSlugs()
	{
		return $this->blogger->getSlugs();
	}

	/**
	 * get slugs from wordpress
	 * @return array list of the slugs from wordpress
	 */
	public function getWordpressSlugs()
	{
		return $this->wordpress->getSlugs();
	}

	/**
	 * We are taking the blogger slug then asking the wordpress if the slug exist in the database, if not store it on the array
	 * @return array the slug that didnt exist on wordpress
	 */
	public function getBrokenSlugs()
	{
		$blogger_slugs = $this->getBloggerSlugs();
		$broken_slugs = [];

		foreach ($blogger_slugs as $blogger_slug) {
			$response = $this->wordpress->checkSlug($blogger_slug);
			if (!$response) {
				$broken_slugs[] = $blogger_slug;
			}
		}

		return $broken_slugs;
	}

	/**
	 * we compare two array of slugs from blogger and wordpress if the part of the slug match, we set the slug from blogger and replace the slug from wordpress 
	 * @param  array $blogger_slugs   slugs from blogger
	 * @param  array $wordpress_slugs slugs from wordpress
	 * @return array                  multidemensional array contain the result
	 */
	private function processSlug($blogger_slugs , $wordpress_slugs)
	{
		$fixed_slugs = [];

		foreach ($blogger_slugs as $blogger_slug) {
				foreach ($wordpress_slugs as $wordpress_slug) {
					if (strpos($wordpress_slug, $blogger_slug) !== false) { //we compare the wordpress and blogger
						//we take $wordpress_slug
						//then we set the slug using the $blogger_slug
						$fixed_slugs[] = $this->wordpress->setSlug($wordpress_slug, $blogger_slug);
					} 
				}
		}


		return [
					'not_fixed'=>array_diff($blogger_slugs, $fixed_slugs), 
					'fixed'=>$fixed_slugs
				];
	}

}




