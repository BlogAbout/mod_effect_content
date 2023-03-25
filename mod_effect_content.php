<?php
defined('_JEXEC') or die;
if(!defined('DS')){ define('DS',DIRECTORY_SEPARATOR); }
require_once dirname(__FILE__).'/helper.php';

switch ($params->get('layout')) {
	case 'categories_joomla': {
		$list = modEffectContentHelper::getListCategoriesJoomla($params);
		break;
	}
	case 'articles_joomla': {
		$list = modEffectContentHelper::getListArticlesJoomla($params);
		break;
	}
	case 'articles_joomla_id': {
		$list = modEffectContentHelper::getListArticlesJoomlaID($params);
		break;
	}
	case 'categories_joomshopping': {
		$list = modEffectContentHelper::getListCategoriesJoomshopping($params);
		break;
	}
	case 'products_joomshopping': {
		$list = modEffectContentHelper::getListProductsJoomshopping($params);
		break;
	}
	case 'products_joomshopping_id': {
		$list = modEffectContentHelper::getListProductsJoomshoppingID($params);
		break;
	}
	case 'categories_k2': {
		$list = modEffectContentHelper::getListCategoriesK2($params);
		break;
	}
	case 'items_k2': {
		$list = modEffectContentHelper::getListItemsK2($params);
		break;
	}
	case 'items_k2_id': {
		$list = modEffectContentHelper::getListItemsK2ID($params);
		break;
	}
	case 'categories_adsmanager': {
		$list = modEffectContentHelper::getListCategoriesAdsManager($params);
		break;
	}
	case 'ads_adsmanager': {
		$list = modEffectContentHelper::getListAdsAdsManager($params);
		break;
	}
	case 'ads_adsmanager_id': {
		$list = modEffectContentHelper::getListAdsAdsManagerID($params);
		break;
	}
}

require JModuleHelper::getLayoutPath('mod_effect_content', $params->get('layout_module', 'default'));
?>