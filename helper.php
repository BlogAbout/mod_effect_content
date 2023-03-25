<?php
defined('_JEXEC') or die;

class modEffectContentHelper
{
	public static function getListCategoriesJoomla(&$params)
	{
		if (count($params->get("com_categories"))) {
			$id_categories = implode(',',$params->get("com_categories"));
			
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('`id`, `title`, `description` AS text, `params`')
				->from($db->quoteName('#__categories'))
				->where($db->quoteName('id') . ' IN (' . $id_categories . ')')
				->where($db->quoteName('published') . '=1');
			
			switch ($params->get("field_sort")) {
				case '1': {
					$query->order($db->quoteName('id') . ' ' . $params->get("type_sort"));
					break;
				}
				case '2': {
					$query->order($db->quoteName('title') . ' ' . $params->get("type_sort"));
					break;
				}
				case '3': {
					$query->order($db->quoteName('created_time') . ' ' . $params->get("type_sort"));
					break;
				}
				case '4': {
					$query->order($db->quoteName('lft') . ' ' . $params->get("type_sort"));
					break;
				}
				case '5': {
					$query->order('RAND()');
					break;
				}
			}
			
			if ((int)$params->get("items_count") > 0) {
				$query->setLimit((int)$params->get("items_count"));
			}
			
			$db->setQuery($query);
			$list = $db->loadObjectList();
			
			return $list;
		}
	}
	
	public static function getListArticlesJoomla(&$params)
	{
		if (count($params->get("com_categories"))) {
			if ($params->get('dinamic_content') == '1'
				&& JRequest::getVar('option', null, 'request', 'string') == 'com_content'
				&& JRequest::getVar('view', null, 'request', 'string') == 'category'
				&& !empty(JRequest::getInt('id', null, 'request', 'int'))
			) {
				$id_categories = JRequest::getInt('id', null, 'request', 'int');
			} else {
				$id_categories = implode(',',$params->get("com_categories"));
			}
			
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('`id`, `title`, `introtext`, `fulltext`, `metadesc`, `publish_up` as date_publish, `catid`, `images`')
				->from($db->quoteName('#__content'))
				->where($db->quoteName('catid') . ' IN (' . $id_categories . ')')
				->where($db->quoteName('state') . '=1');
			
			if ($params->get('exclude_active') == '1' && JRequest::getVar('option', null, 'request', 'string') == 'com_content') {
				$query->where($db->quoteName('id') . ' NOT IN (' . JRequest::getInt('id', null, 'request', 'int') . ')');
			}
			
			switch ($params->get("field_sort")) {
				case '1': {
					$query->order($db->quoteName('id') . ' ' . $params->get("type_sort"));
					break;
				}
				case '2': {
					$query->order($db->quoteName('title') . ' ' . $params->get("type_sort"));
					break;
				}
				case '3': {
					$query->order($db->quoteName('created') . ' ' . $params->get("type_sort"));
					break;
				}
				case '4': {
					$query->order($db->quoteName('ordering') . ' ' . $params->get("type_sort"));
					break;
				}
				case '5': {
					$query->order('RAND()');
					break;
				}
			}
			
			if ((int)$params->get("items_count") > 0) {
				$query->setLimit((int)$params->get("items_count"));
			}
			
			$db->setQuery($query);
			$list = $db->loadObjectList();
			
			return $list;
		}
	}
	
	public static function getListArticlesJoomlaID(&$params)
	{
		if (count($params->get("articles_id"))) {
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			
			if ($params->get('dinamic_content') == '1'
				&& JRequest::getVar('option', null, 'request', 'string') == 'com_content'
				&& JRequest::getVar('view', null, 'request', 'string') == 'category'
				&& !empty(JRequest::getInt('id', null, 'request', 'int'))
			) {
				$id_categories = JRequest::getInt('id', null, 'request', 'int');
				$query->select('`id`, `title`, `introtext`, `fulltext`, `metadesc`, `publish_up` as date_publish, `catid`, `images`')
					->from($db->quoteName('#__content'))
					->where($db->quoteName('catid') . ' IN (' . $id_categories . ')')
					->where($db->quoteName('state') . '=1');
			} else {
				$id_articles = preg_replace('/[^0-9\,]/', '', $params->get("articles_id"));
				$query->select('`id`, `title`, `introtext`, `fulltext`, `metadesc`, `publish_up` as date_publish, `catid`, `images`')
					->from($db->quoteName('#__content'))
					->where($db->quoteName('id') . ' IN (' . $id_articles . ')')
					->where($db->quoteName('state') . '=1');
			}
			
			if ($params->get('exclude_active') == '1' && JRequest::getVar('option', null, 'request', 'string') == 'com_content') {
				$query->where($db->quoteName('id') . ' NOT IN (' . JRequest::getInt('id', null, 'request', 'int') . ')');
			}
			
			switch ($params->get("field_sort")) {
				case '1': {
					$query->order($db->quoteName('id') . ' ' . $params->get("type_sort"));
					break;
				}
				case '2': {
					$query->order($db->quoteName('title') . ' ' . $params->get("type_sort"));
					break;
				}
				case '3': {
					$query->order($db->quoteName('created') . ' ' . $params->get("type_sort"));
					break;
				}
				case '4': {
					$query->order($db->quoteName('ordering') . ' ' . $params->get("type_sort"));
					break;
				}
				case '5': {
					$query->order('RAND()');
					break;
				}
			}
			
			if ((int)$params->get("items_count") > 0) {
				$query->setLimit((int)$params->get("items_count"));
			}
			
			$db->setQuery($query);
			$list = $db->loadObjectList();
			
			return $list;
		}
	}
	
	public static function getListCategoriesJoomshopping(&$params)
	{
		if (count($params->get("jshoppingcategories"))) {
			$id_categories = implode(',',$params->get("jshoppingcategories"));
			
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('`category_id` AS id, `name_ru-RU` AS title, `description_ru-RU` AS text, `category_image` AS image')
				->from($db->quoteName('#__jshopping_categories'))
				->where($db->quoteName('category_id') . ' IN (' . $id_categories . ')')
				->where($db->quoteName('category_publish') . '=1');
			
			switch ($params->get("field_sort")) {
				case '1': {
					$query->order($db->quoteName('category_id') . ' ' . $params->get("type_sort"));
					break;
				}
				case '2': {
					$query->order($db->quoteName('name_ru-RU') . ' ' . $params->get("type_sort"));
					break;
				}
				case '3': {
					$query->order($db->quoteName('category_add_date') . ' ' . $params->get("type_sort"));
					break;
				}
				case '4': {
					$query->order($db->quoteName('ordering') . ' ' . $params->get("type_sort"));
					break;
				}
				case '5': {
					$query->order('RAND()');
					break;
				}
			}
			
			if ((int)$params->get("items_count") > 0) {
				$query->setLimit((int)$params->get("items_count"));
			}
			
			$db->setQuery($query);
			$list = $db->loadObjectList();
			
			return $list;
		}
	}
	
	public static function getListProductsJoomshopping(&$params)
	{
		if (count($params->get("jshoppingcategories"))) {
			if ($params->get('dinamic_content') == '1'
				&& JRequest::getVar('option', null, 'request', 'string') == 'com_jshopping'
				&& JRequest::getVar('view', null, 'request', 'string') == 'category'
				&& JRequest::getVar('layout', null, 'request', 'string') == 'category'
				&& !empty(JRequest::getInt('category_id', null, 'request', 'int'))
			) {
				$id_categories = JRequest::getInt('category_id', null, 'request', 'int');
			} else {
				$id_categories = implode(',',$params->get("jshoppingcategories"));
			}
			
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('prod.`product_id` AS id, prod.`name_ru-RU` AS title, prod.`short_description_ru-RU` AS text, prod.`image`, prod.`product_price`, prod.`product_date_added` as date_publish, curr.`currency_code`, cat.`category_id`')
				->from($db->quoteName('#__jshopping_products') . ' AS prod')
				->leftJoin('#__jshopping_products_to_categories AS cat ON cat.product_id = prod.product_id')
				->leftJoin('#__jshopping_currencies AS curr ON curr.currency_id = prod.currency_id')
				->where('prod.`product_publish` = 1')
				->where('cat.`category_id` IN (' . $id_categories . ')')
				->group('prod.`product_id`');
			
			if ($params->get('exclude_active') == '1' && JRequest::getVar('option', null, 'request', 'string') == 'com_jshopping') {
				$query->where($db->quoteName('product_id') . ' NOT IN (' . JRequest::getInt('product_id', null, 'request', 'int') . ')');
			}
			
			switch ($params->get("field_sort")) {
				case '1': {
					$query->order('prod.' . $db->quoteName('product_id') . ' ' . $params->get("type_sort"));
					break;
				}
				case '2': {
					$query->order('prod.' . $db->quoteName('name_ru-RU') . ' ' . $params->get("type_sort"));
					break;
				}
				case '3': {
					$query->order('prod.' . $db->quoteName('product_date_added') . ' ' . $params->get("type_sort"));
					break;
				}
				case '4': {
					$query->order('cat.' . $db->quoteName('product_ordering') . ' ' . $params->get("type_sort"));
					break;
				}
				case '5': {
					$query->order('RAND()');
					break;
				}
			}
			
			if ((int)$params->get("items_count") > 0) {
				$query->setLimit((int)$params->get("items_count"));
			}
			
			$db->setQuery($query);
			$list = $db->loadObjectList();
			
			return $list;
		}
	}
	
	public static function getListProductsJoomshoppingID(&$params)
	{
		if (count($params->get("products_id"))) {
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			
			if ($params->get('dinamic_content') == '1'
				&& JRequest::getVar('option', null, 'request', 'string') == 'com_jshopping'
				&& JRequest::getVar('view', null, 'request', 'string') == 'category'
				&& JRequest::getVar('layout', null, 'request', 'string') == 'category'
				&& !empty(JRequest::getInt('category_id', null, 'request', 'int'))
			) {
				$id_categories = JRequest::getInt('category_id', null, 'request', 'int');
				$query->select('prod.`product_id` AS id, prod.`name_ru-RU` AS title, prod.`short_description_ru-RU` AS text, prod.`image`, prod.`product_price`, prod.`product_date_added` as date_publish, curr.`currency_code`, cat.`category_id`')
					->from($db->quoteName('#__jshopping_products') . ' AS prod')
					->leftJoin('#__jshopping_products_to_categories AS cat ON cat.product_id = prod.product_id')
					->leftJoin('#__jshopping_currencies AS curr ON curr.currency_id = prod.currency_id')
					->where('prod.`product_publish` = 1')
					->where('cat.`category_id` IN (' . $id_categories . ')')
					->group('prod.`product_id`');
			} else {
				$id_products = preg_replace('/[^0-9\,]/', '', $params->get("products_id"));
				$query->select('prod.`product_id` AS id, prod.`name_ru-RU` AS title, prod.`short_description_ru-RU` AS text, prod.`image`, prod.`product_price`, prod.`product_date_added` as date_publish, curr.`currency_code`, cat.`category_id`')
					->from($db->quoteName('#__jshopping_products') . ' AS prod')
					->leftJoin('#__jshopping_products_to_categories AS cat ON cat.product_id = prod.product_id')
					->leftJoin('#__jshopping_currencies AS curr ON curr.currency_id = prod.currency_id')
					->where('prod.`product_publish` = 1')
					->where('prod.`product_id` IN (' . $id_products . ')')
					->group('prod.`product_id`');
			}
			
			if ($params->get('exclude_active') == '1' && JRequest::getVar('option', null, 'request', 'string') == 'com_jshopping') {
				$query->where($db->quoteName('product_id') . ' NOT IN (' . JRequest::getInt('product_id', null, 'request', 'int') . ')');
			}
			
			switch ($params->get("field_sort")) {
				case '1': {
					$query->order('prod.' . $db->quoteName('product_id') . ' ' . $params->get("type_sort"));
					break;
				}
				case '2': {
					$query->order('prod.' . $db->quoteName('name_ru-RU') . ' ' . $params->get("type_sort"));
					break;
				}
				case '3': {
					$query->order('prod.' . $db->quoteName('product_date_added') . ' ' . $params->get("type_sort"));
					break;
				}
				case '4': {
					$query->order('cat.' . $db->quoteName('product_ordering') . ' ' . $params->get("type_sort"));
					break;
				}
				case '5': {
					$query->order('RAND()');
					break;
				}
			}
			
			if ((int)$params->get("items_count") > 0) {
				$query->setLimit((int)$params->get("items_count"));
			}
			
			$db->setQuery($query);
			$list = $db->loadObjectList();
			
			return $list;
		}
	}
	
	public static function getListCategoriesK2(&$params)
	{
		if (count($params->get("k2categories"))) {
			$id_categories = implode(',',$params->get("k2categories"));
			
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('`id`, `name` AS title, `description` AS text, `image`, `alias`')
				->from($db->quoteName('#__k2_categories'))
				->where($db->quoteName('id') . ' IN (' . $id_categories . ')')
				->where($db->quoteName('published') . '=1');
			
			switch ($params->get("field_sort")) {
				case '1': {
					$query->order($db->quoteName('id') . ' ' . $params->get("type_sort"));
					break;
				}
				case '2': {
					$query->order($db->quoteName('name') . ' ' . $params->get("type_sort"));
					break;
				}
				case '3': {
					//$query->order($db->quoteName('created_time') . ' ' . $params->get("type_sort"));
					break;
				}
				case '4': {
					$query->order($db->quoteName('parent') . ' ' . $params->get("type_sort"));
					$query->order($db->quoteName('ordering') . ' ' . $params->get("type_sort"));
					break;
				}
				case '5': {
					$query->order('RAND()');
					break;
				}
			}
			
			if ((int)$params->get("items_count") > 0) {
				$query->setLimit((int)$params->get("items_count"));
			}
			
			$db->setQuery($query);
			$list = $db->loadObjectList();
			
			return $list;
		}
	}
	
	public static function getListItemsK2(&$params)
	{
		if (count($params->get("k2categories"))) {
			if ($params->get('dinamic_content') == '1'
				&& JRequest::getVar('option', null, 'request', 'string') == 'com_k2'
				&& JRequest::getVar('view', null, 'request', 'string') == 'itemlist'
				&& !empty(JRequest::getVar('id', null, 'request'))
			) {
				$id_categories = explode(':', JRequest::getVar('id', null, 'request'));
				$id_categories = $id_categories[0];
			} else {
				$id_categories = implode(',',$params->get("k2categories"));
			}
			
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('items.`id`, items.`title`, items.`introtext` AS text, items.`catid`, items.`alias`, items.`publish_up` as date_publish, cat.`alias` AS cat_alias')
				->from($db->quoteName('#__k2_items') . ' AS items')
				->leftJoin('`#__k2_categories` AS cat ON cat.`id` = items.`catid`')
				->where('items.' . $db->quoteName('catid') . ' IN (' . $id_categories . ')')
				->where('items.' . $db->quoteName('published') . '=1');
			
			if ($params->get('exclude_active') == '1' && JRequest::getVar('option', null, 'request', 'string') == 'com_k2') {
				$query->where($db->quoteName('id') . ' NOT IN (' . JRequest::getInt('id', null, 'request', 'int') . ')');
			}
			
			switch ($params->get("field_sort")) {
				case '1': {
					$query->order('items.' . $db->quoteName('id') . ' ' . $params->get("type_sort"));
					break;
				}
				case '2': {
					$query->order('items.' . $db->quoteName('title') . ' ' . $params->get("type_sort"));
					break;
				}
				case '3': {
					$query->order('items.' . $db->quoteName('created') . ' ' . $params->get("type_sort"));
					break;
				}
				case '4': {
					$query->order('items.' . $db->quoteName('catid') . ' ' . $params->get("type_sort"));
					$query->order('items.' . $db->quoteName('ordering') . ' ' . $params->get("type_sort"));
					break;
				}
				case '5': {
					$query->order('RAND()');
					break;
				}
			}
			
			if ((int)$params->get("items_count") > 0) {
				$query->setLimit((int)$params->get("items_count"));
			}
			
			$db->setQuery($query);
			$list = $db->loadObjectList();
			
			return $list;
		}
	}
	
	public static function getListItemsK2ID(&$params)
	{
		if (count($params->get("k2items_id"))) {
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			
			if ($params->get('dinamic_content') == '1'
				&& JRequest::getVar('option', null, 'request', 'string') == 'com_k2'
				&& JRequest::getVar('view', null, 'request', 'string') == 'itemlist'
				&& !empty(JRequest::getVar('id', null, 'request'))
			) {
				$id_categories = explode(':', JRequest::getVar('id', null, 'request'));
				$id_categories = $id_categories[0];
				$query->select('items.`id`, items.`title`, items.`introtext` AS text, items.`catid`, items.`alias`, items.`publish_up` as date_publish, cat.`alias` AS cat_alias')
					->from($db->quoteName('#__k2_items') . ' AS items')
					->leftJoin('`#__k2_categories` AS cat ON cat.`id` = items.`catid`')
					->where('items.' . $db->quoteName('catid') . ' IN (' . $id_categories . ')')
					->where('items.' . $db->quoteName('published') . '=1');
			} else {
				$id_items = preg_replace('/[^0-9\,]/', '', $params->get("k2items_id"));
				$query->select('items.`id`, items.`title`, items.`introtext` AS text, items.`catid`, items.`alias`, items.`publish_up` as date_publish, cat.`alias` AS cat_alias')
					->from($db->quoteName('#__k2_items') . ' AS items')
					->leftJoin('`#__k2_categories` AS cat ON cat.`id` = items.`catid`')
					->where('items.' . $db->quoteName('id') . ' IN (' . $id_items . ')')
					->where('items.' . $db->quoteName('published') . '=1');
			}
			
			if ($params->get('exclude_active') == '1' && JRequest::getVar('option', null, 'request', 'string') == 'com_k2') {
				$query->where($db->quoteName('id') . ' NOT IN (' . JRequest::getInt('id', null, 'request', 'int') . ')');
			}
			
			switch ($params->get("field_sort")) {
				case '1': {
					$query->order('items.' . $db->quoteName('id') . ' ' . $params->get("type_sort"));
					break;
				}
				case '2': {
					$query->order('items.' . $db->quoteName('title') . ' ' . $params->get("type_sort"));
					break;
				}
				case '3': {
					$query->order('items.' . $db->quoteName('created') . ' ' . $params->get("type_sort"));
					break;
				}
				case '4': {
					$query->order('items.' . $db->quoteName('catid') . ' ' . $params->get("type_sort"));
					$query->order('items.' . $db->quoteName('ordering') . ' ' . $params->get("type_sort"));
					break;
				}
				case '5': {
					$query->order('RAND()');
					break;
				}
			}
			
			if ((int)$params->get("items_count") > 0) {
				$query->setLimit((int)$params->get("items_count"));
			}
			
			$db->setQuery($query);
			$list = $db->loadObjectList();
			
			return $list;
		}
	}
	
	public static function getListCategoriesAdsManager(&$params)
	{
		if (count($params->get("adsmanagercategories"))) {
			$id_categories = implode(',',$params->get("adsmanagercategories"));
			
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('`id`, `name` AS title, `description` AS text')
				->from($db->quoteName('#__adsmanager_categories'))
				->where($db->quoteName('id') . ' IN (' . $id_categories . ')')
				->where($db->quoteName('published') . '=1');
			
			switch ($params->get("field_sort")) {
				case '1': {
					$query->order($db->quoteName('id') . ' ' . $params->get("type_sort"));
					break;
				}
				case '2': {
					$query->order($db->quoteName('name') . ' ' . $params->get("type_sort"));
					break;
				}
				case '3': {
					//$query->order($db->quoteName('created_time') . ' ' . $params->get("type_sort"));
					break;
				}
				case '4': {
					$query->order($db->quoteName('parent') . ' ' . $params->get("type_sort"));
					$query->order($db->quoteName('ordering') . ' ' . $params->get("type_sort"));
					break;
				}
				case '5': {
					$query->order('RAND()');
					break;
				}
			}
			
			if ((int)$params->get("items_count") > 0) {
				$query->setLimit((int)$params->get("items_count"));
			}
			
			$db->setQuery($query);
			$list = $db->loadObjectList();
			
			return $list;
		}
	}
	
	public static function getListAdsAdsManager(&$params)
	{
		if (count($params->get("adsmanagercategories"))) {
			if ($params->get('dinamic_content') == '1'
				&& JRequest::getVar('option', null, 'request', 'string') == 'com_adsmanager'
				&& !empty(JRequest::getInt('catid', null, 'request', 'int'))
			) {
				$id_categories = JRequest::getInt('catid', null, 'request', 'int');
			} else {
				$id_categories = implode(',',$params->get("adsmanagercategories"));
			}
			
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('ads.`id`, ads.`ad_headline` AS title, ads.`ad_text` AS text, ads.`images` AS image, ads.`publication_date` as date_publish, cat.`catid`')
				->from($db->quoteName('#__adsmanager_ads') . ' AS ads')
				->leftJoin('#__adsmanager_adcat AS cat ON cat.adid = ads.id')
				->where('ads.`published` = 1')
				->where('cat.`catid` IN (' . $id_categories . ')')
				->group('ads.`id`');
			
			if ($params->get('exclude_active') == '1' && JRequest::getVar('option', null, 'request', 'string') == 'com_adsmanager') {
				$query->where($db->quoteName('id') . ' NOT IN (' . JRequest::getInt('id', null, 'request', 'int') . ')');
			}
			
			switch ($params->get("field_sort")) {
				case '1': {
					$query->order('ads.' . $db->quoteName('id') . ' ' . $params->get("type_sort"));
					break;
				}
				case '2': {
					$query->order('ads.' . $db->quoteName('ad_headline') . ' ' . $params->get("type_sort"));
					break;
				}
				case '3': {
					$query->order('ads.' . $db->quoteName('date_created') . ' ' . $params->get("type_sort"));
					break;
				}
				case '4': {
					//$query->order('cat.' . $db->quoteName('') . ' ' . $params->get("type_sort"));
					break;
				}
				case '5': {
					$query->order('RAND()');
					break;
				}
			}
			
			if ((int)$params->get("items_count") > 0) {
				$query->setLimit((int)$params->get("items_count"));
			}
			
			$db->setQuery($query);
			$list = $db->loadObjectList();
			
			return $list;
		}
	}
	
	public static function getListAdsAdsManagerID(&$params)
	{
		if (count($params->get("ads_id"))) {
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			
			if ($params->get('dinamic_content') == '1'
				&& JRequest::getVar('option', null, 'request', 'string') == 'com_adsmanager'
				&& !empty(JRequest::getInt('catid', null, 'request', 'int'))
			) {
				$id_categories = JRequest::getInt('catid', null, 'request', 'int');
				$query->select('ads.`id`, ads.`ad_headline` AS title, ads.`ad_text` AS text, ads.`images` AS image, ads.`publication_date` as date_publish, cat.`catid`')
					->from($db->quoteName('#__adsmanager_ads') . ' AS ads')
					->leftJoin('#__adsmanager_adcat AS cat ON cat.adid = ads.id')
					->where('ads.`published` = 1')
					->where('cat.`catid` IN (' . $id_categories . ')')
					->group('ads.`id`');
			} else {
				$id_products = preg_replace('/[^0-9\,]/', '', $params->get("ads_id"));
				$query->select('ads.`id`, ads.`ad_headline` AS title, ads.`ad_text` AS text, ads.`images` AS image, ads.`publication_date` as date_publish, cat.`catid`')
					->from($db->quoteName('#__adsmanager_ads') . ' AS ads')
					->leftJoin('#__adsmanager_adcat AS cat ON cat.adid = ads.id')
					->where('ads.`published` = 1')
					->where('ads.`id` IN (' . $id_products . ')')
					->group('ads.`id`');
			}
			
			if ($params->get('exclude_active') == '1' && JRequest::getVar('option', null, 'request', 'string') == 'com_adsmanager') {
				$query->where($db->quoteName('id') . ' NOT IN (' . JRequest::getInt('id', null, 'request', 'int') . ')');
			}
			
			switch ($params->get("field_sort")) {
				case '1': {
					$query->order('ads.' . $db->quoteName('id') . ' ' . $params->get("type_sort"));
					break;
				}
				case '2': {
					$query->order('ads.' . $db->quoteName('ad_headline') . ' ' . $params->get("type_sort"));
					break;
				}
				case '3': {
					$query->order('ads.' . $db->quoteName('date_created') . ' ' . $params->get("type_sort"));
					break;
				}
				case '4': {
					//$query->order('cat.' . $db->quoteName('') . ' ' . $params->get("type_sort"));
					break;
				}
				case '5': {
					$query->order('RAND()');
					break;
				}
			}
			
			if ((int)$params->get("items_count") > 0) {
				$query->setLimit((int)$params->get("items_count"));
			}
			
			$db->setQuery($query);
			$list = $db->loadObjectList();
			
			return $list;
		}
	}
}