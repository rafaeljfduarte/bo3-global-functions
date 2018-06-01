<?php

class _global_ {

	public static $helloWorldString = "Hello World!";

	public function __construct() {}

	public static function start () {
		print self::$helloWorldString;
	}

	public static function getSubCategories($parent_id = null) {
		global $lg;

		if(!empty($parent_id)) {
			$cats = new category();
			$cats->setParentId($parent_id);
			$cats->setLangId($lg);
			return $cats->returnChildCategories();
		} else {
			return false;
		}
	}

	public static function getCategory($id = null) {
		global $cfg, $lg;

		if(isset($id) && !empty($id)) {
			$cat = new category();
			$cat->setId($id);
			$cat->setLangId($lg);
			$cat = $cat->returnOneCategory();

			return $cat;
		} else {
			return false;
		}
	}

	public static function getNumberOfArticles($cat_id = null) {
	global $cfg, $lg;

	if(isset($cat_id) && !empty($cat_id)) {
		$articles = new article();
		$articles->setCategoryId($cat_id);
		$articles->setLangId($lg);
		$articles = $articles->returnNumberOfArticles('true', 'date DESC');

		return $articles;
	} else {
		return false;
	}
}

	public static function getArticle($id = null) {
		global $cfg, $lg;

		if(isset($id) && !empty($id)) {
			$article = new article();
			$article->setId($id);
			$article->setLangId($lg);
			$article = $article->returnOneArticle();

			return $article;
		} else {
			return false;
		}
	}

	public static function getArticles($cat_id = null, $where = null, $order = null, $limit = null) {
		global $lg;

		if(isset($cat_id) && !empty($cat_id)) {
			$articles = new article();
			$articles->setCategoryId($cat_id);
			$articles->setLangId($lg);
			$articles = $articles->returnArticlesByCategory(
				(!empty($where)) ? $where : "true",
				$order,
				$limit
			);

			return $articles;
		} else {
			return false;
		}
	}

	public static function getNews($id = null, $order = null, $start = null) {
		global $cfg, $lg;
		$limit = $start." , ".$cfg->system->per_page;
		if(isset($id) && !empty($id)) {
			$articles = new article();
			$articles->setCategoryId($id);
			$articles->setLangId($lg);
			$articles = $articles->returnArticlesByCategory("published = '1'", $order, $limit);
			return $articles;
		} else {
			return false;
		}
	}

	public static function excerpt ($string = null, $length = 0) {
	if (!empty($string) && ($length > 0)) {
		return substr($string, 0, $length).'...';
	} else {
		return false;
	}
}

	public static function getFile($id_ass = null, $type = null, $module = null, $code = null) {
		global $cfg, $lg;
		if(!empty($id_ass) && !empty($type) && !empty($module)) {
			$files = new file();
			$files->setIdAss($id_ass);
			$files->setType($type);
			$files->setModule($module);
			if(!empty($code)) {$files->setCode(["{$code}"]);}
			$files = $files->returnFiles();

			return $files;
		} else {
			return false;
		}
	}
}
