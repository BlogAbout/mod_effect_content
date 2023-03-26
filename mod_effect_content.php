<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

require_once dirname(__FILE__).'/helper.php';

switch ($params->get('layout')) {
    case 'categories_joomla':
    {
        $list = ModEffectContentHelper::getListCategoriesJoomla($params);
        break;
    }
    case 'articles_joomla':
    {
        $list = ModEffectContentHelper::getListArticlesJoomla($params);
        break;
    }
    case 'articles_joomla_id':
    {
        $list = ModEffectContentHelper::getListArticlesJoomlaID($params);
        break;
    }
    case 'categories_joomshopping':
    {
        $list = ModEffectContentHelper::getListCategoriesJoomshopping($params);
        break;
    }
    case 'products_joomshopping':
    {
        $list = ModEffectContentHelper::getListProductsJoomshopping($params);
        break;
    }
    case 'products_joomshopping_id':
    {
        $list = ModEffectContentHelper::getListProductsJoomshoppingID($params);
        break;
    }
    case 'categories_k2':
    {
        $list = ModEffectContentHelper::getListCategoriesK2($params);
        break;
    }
    case 'items_k2':
    {
        $list = ModEffectContentHelper::getListItemsK2($params);
        break;
    }
    case 'items_k2_id':
    {
        $list = ModEffectContentHelper::getListItemsK2ID($params);
        break;
    }
    case 'categories_adsmanager':
    {
        $list = ModEffectContentHelper::getListCategoriesAdsManager($params);
        break;
    }
    case 'ads_adsmanager':
    {
        $list = ModEffectContentHelper::getListAdsAdsManager($params);
        break;
    }
    case 'ads_adsmanager_id':
    {
        $list = ModEffectContentHelper::getListAdsAdsManagerID($params);
        break;
    }
}

require ModuleHelper::getLayoutPath('mod_effect_content', $params->get('layout_module', 'default'));