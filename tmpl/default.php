<?php
defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

$doc = \JFactory::getDocument();
$doc->addStyleSheet('modules/mod_effect_content/css/style.css?v0.4.1');
$doc->addStyleSheet('modules/mod_effect_content/css/effects.css?v0.4.1');

if ($params->get('pages_count') > 0) {
    $doc->addScript('modules/mod_effect_content/js/script.js?v0.4.1');
}

$styles = '';

if ($params->get('color_bg')) {
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents .view {
			background-color: ' . $params->get('color_bg') . ';
		}
	';
}

if ($params->get('color_bg_hover')) {
    $hex = $params->get('color_bg_hover');
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    if ($params->get('color_bg_hover_opacity')) {
        $opacity = $params->get('color_bg_hover_opacity');
    } else {
        $opacity = 0;
    }
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents .view .mask {
			background-color: rgba(' . $r . ', ' . $g . ', ' . $b . ', ' . $opacity . ');
		}
	';
}

if ($params->get('color_title')) {
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents .view h2 {
			color: ' . $params->get('color_title') . ';
		}
	';
}

if ($params->get('color_title_bg')) {
    $hex = $params->get('color_title_bg');
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    if ($params->get('color_title_bg_opacity')) {
        $opacity = $params->get('color_title_bg_opacity');
    } else {
        $opacity = 0;
    }
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents .view h2 {
			background-color: rgba(' . $r . ', ' . $g . ', ' . $b . ', ' . $opacity . ');
		}
	';
}

if ($params->get('color_desc')) {
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents .view p {
			color: ' . $params->get('color_desc') . ';
		}
	';
}

if ($params->get('color_desc_bg')) {
    $hex = $params->get('color_desc_bg');
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    if ($params->get('color_desc_bg_opacity')) {
        $opacity = $params->get('color_desc_bg_opacity');
    } else {
        $opacity = 0;
    }
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents .view p {
			background-color: rgba(' . $r . ', ' . $g . ', ' . $b . ', ' . $opacity . ');
		}
	';
}

if ($params->get('color_price')) {
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents .view .price {
			color: ' . $params->get('color_price') . ';
		}
	';
}

if ($params->get('color_price_bg')) {
    $hex = $params->get('color_price_bg');
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    if ($params->get('color_price_bg_opacity')) {
        $opacity = $params->get('color_price_bg_opacity');
    } else {
        $opacity = 0;
    }
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents .view .price {
			background-color: rgba(' . $r . ', ' . $g . ', ' . $b . ', ' . $opacity . ');
		}
	';
}

if ($params->get('color_button')) {
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents .view a.readmore,
		#module_effect_contents_' . $module->id . '.list_contents .view span.readmore {
			background-color: ' . $params->get('color_button') . ';
		}
	';
}

if ($params->get('color_button_hover')) {
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents .view a.readmore:hover,
		#module_effect_contents_' . $module->id . '.list_contents .view span.readmore:hover {
			background-color: ' . $params->get('color_button_hover') . ';
		}
	';
}

if ($params->get('color_button_text')) {
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents .view a.readmore,
		#module_effect_contents_' . $module->id . '.list_contents .view span.readmore {
			color: ' . $params->get('color_button_text') . ';
		}
	';
}

if ($params->get('color_button_text_hover')) {
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents .view a.readmore:hover,
		#module_effect_contents_' . $module->id . '.list_contents .view span.readmore:hover {
			color: ' . $params->get('color_button_text_hover') . ';
		}
	';
}

if ($params->get('pages_count') > 0) {
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents .page_content.active {
			display: -webkit-flex;
			display: -moz-flex;
			display: -ms-flex;
			display: -o-flex;
			display: flex;
			flex-wrap: wrap;
		}
	';
} else {
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents {
			display: -webkit-flex;
			display: -moz-flex;
			display: -ms-flex;
			display: -o-flex;
			display: flex;
			flex-wrap: wrap;
		}
	';
}

if ($params->get('center_blocks')) {
    $styles .= '
		#module_effect_contents_' . $module->id . '.list_contents,
		#module_effect_contents_' . $module->id . '.list_contents .page_content.active {
			justify-content: center;
		}
	';
}
// Расчет размеров блока
if ($params->get('cols_count') > 0) {
    $width_block = (number_format(100 / $params->get('cols_count'), 0) - 2) . '%';
    $margin_block = '1%';
} else {
    $width_block = ($params->get('block_width') - 10) . 'px';
    $margin_block = '10px';
}
$styles .= '
	#module_effect_contents_' . $module->id . '.list_contents .view {
		width: ' . $width_block . ';
		margin: ' . $margin_block . ';
		height: ' . $params->get('block_height') . 'px;
	}
';

// Расчет размеров изображения
if ((int)$params->get('image_width') > 0) {
    $width_image = $params->get('image_width') . 'px';
} else {
    if ((int)$params->get('image_height') == 0) {
        $width_image = '100%';
    } else {
        $width_image = 'auto';
    }
}
if ((int)$params->get('image_height') > 0) {
    $height_image = $params->get('image_height') . 'px';
} else {
    if ((int)$params->get('image_width') == 0) {
        $height_image = '100%';
    } else {
        $height_image = 'auto';
    }
}
$styles .= '
	#module_effect_contents_' . $module->id . '.list_contents .view img {
		width: ' . $width_image . ';
		height: ' . $height_image . ';
	}
';

if ($params->get('media_tablet')) {
    if ($params->get('cols_count_tablet') > 0) {
        $width_block = (number_format(100 / $params->get('cols_count_tablet'), 0) - 2) . '%';
        $margin_block = '1%';
    } else {
        $width_block = ($params->get('block_width_tablet') - 10) . 'px';
        $margin_block = '10px';
    }
    if ((int)$params->get('image_width_tablet') > 0) {
        $width_image = $params->get('image_width_tablet') . 'px';
    } else {
        if ((int)$params->get('image_height_tablet') == 0) {
            $width_image = '100%';
        } else {
            $width_image = 'auto';
        }
    }
    if ((int)$params->get('image_height_tablet') > 0) {
        $height_image = $params->get('image_height_tablet') . 'px';
    } else {
        if ((int)$params->get('image_width_tablet') == 0) {
            $height_image = 'height: 100%';
        } else {
            $height_image = 'auto';
        }
    }
    $styles .= '
		@media (max-width: 1023px) and (min-width: 768px) {
			#module_effect_contents_' . $module->id . '.list_contents .view {
				width: ' . $width_block . ';
				margin: ' . $margin_block . ';
				height: ' . $params->get('block_height_tablet') . 'px;
			}
			#module_effect_contents_' . $module->id . '.list_contents .view img {
				width: ' . $width_image . ';
				height: ' . $height_image . ';
			}
		}
	';
}

if ($params->get('media_mobile')) {
    if ($params->get('cols_count_mobile') > 0) {
        $width_block = (number_format(100 / $params->get('cols_count_mobile'), 0) - 2) . '%';
        $margin_block = '1%';
    } else {
        $width_block = ($params->get('block_width_mobile') - 10) . 'px';
        $margin_block = '10px';
    }
    if ((int)$params->get('image_width_mobile') > 0) {
        $width_image = $params->get('image_width_mobile') . 'px';
    } else {
        if ((int)$params->get('image_height_mobile') == 0) {
            $width_image = '100%';
        } else {
            $width_image = 'auto';
        }
    }
    if ((int)$params->get('image_height_mobile') > 0) {
        $height_image = $params->get('image_height_mobile') . 'px';
    } else {
        if ((int)$params->get('image_width_mobile') == 0) {
            $height_image = 'height: 100%';
        } else {
            $height_image = 'auto';
        }
    }
    $styles .= '
		@media (max-width: 767px) {
			#module_effect_contents_' . $module->id . '.list_contents .view {
				width: ' . $width_block . ';
				margin: ' . $margin_block . ';
				height: ' . $params->get('block_height_mobile') . 'px;
			}
			#module_effect_contents_' . $module->id . '.list_contents .view img {
				width: ' . $width_image . ';
				height: ' . $height_image . ';
			}
		}
	';
}

$doc->addStyleDeclaration($styles);

switch ($params->get('layout')) {
    case 'categories_joomla' :
    {
        if (!count($list)) {
            $error = \JText::_('MOD_EFFECT_CONTENT_NO_CATEGORIES_JOOMLA');
        }
        break;
    }
    case 'articles_joomla' :
    {
        if (!count($list)) {
            $error = \JText::_('MOD_EFFECT_CONTENT_NO_ARTICLES_JOOMLA');
        }
        break;
    }
    case 'articles_joomla_id' :
    {
        if (!count($list)) {
            $error = \JText::_('MOD_EFFECT_CONTENT_NO_ARTICLES_JOOMLA_ID');
        }
        break;
    }
    case 'categories_joomshopping' :
    {
        if (!count($list)) {
            if (\JFile::exists(JPATH_SITE . DS . 'components' . DS . 'com_jshopping' . DS . 'bootstrap.php')) {
                $error = \JText::_('MOD_EFFECT_CONTENT_NO_CATEGORIES_JOOMSHOPPING');
            } else {
                $error = \JText::_('MOD_EFFECT_CONTENT_JOOMSHOPPING_NOT_INSTALLED');
            }
        } else {
            require_once(JPATH_SITE . '/components/com_jshopping/bootstrap.php');
        }
        break;
    }
    case 'products_joomshopping' :
    {
        if (!count($list)) {
            if (\JFile::exists(JPATH_SITE . DS . 'components' . DS . 'com_jshopping' . DS . 'bootstrap.php')) {
                $error = \JText::_('MOD_EFFECT_CONTENT_NO_PRODUCTS_JOOMSHOPPING');
            } else {
                $error = \JText::_('MOD_EFFECT_CONTENT_JOOMSHOPPING_NOT_INSTALLED');
            }
        } else {
            require_once(JPATH_SITE . '/components/com_jshopping/bootstrap.php');
        }
        break;
    }
    case 'products_joomshopping_id' :
    {
        if (!count($list)) {
            if (\JFile::exists(JPATH_SITE . DS . 'components' . DS . 'com_jshopping' . DS . 'bootstrap.php')) {
                $error = \JText::_('MOD_EFFECT_CONTENT_NO_PRODUCTS_JOOMSHOPPING_ID');
            } else {
                $error = \JText::_('MOD_EFFECT_CONTENT_JOOMSHOPPING_NOT_INSTALLED');
            }
        } else {
            require_once(JPATH_SITE . '/components/com_jshopping/bootstrap.php');
        }
        break;
    }
//    case 'categories_k2' :
//    {
//        if (!count($list)) {
//            if (\JFile::exists(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_k2' . DS . 'k2.php')) {
//                $error = \JText::_('MOD_EFFECT_CONTENT_NO_CATEGORIES_K2');
//            } else {
//                $error = \JText::_('MOD_EFFECT_CONTENT_K2_NOT_INSTALLED');
//            }
//        } else {
//            require_once(JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php');
//        }
//        break;
//    }
//    case 'items_k2' :
//    {
//        if (!count($list)) {
//            if (\JFile::exists(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_k2' . DS . 'k2.php')) {
//                $error = \JText::_('MOD_EFFECT_CONTENT_NO_ITEMS_K2');
//            } else {
//                $error = \JText::_('MOD_EFFECT_CONTENT_K2_NOT_INSTALLED');
//            }
//        } else {
//            require_once(JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php');
//        }
//        break;
//    }
//    case 'items_k2_id' :
//    {
//        if (!count($list)) {
//            if (\JFile::exists(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_k2' . DS . 'k2.php')) {
//                $error = \JText::_('MOD_EFFECT_CONTENT_NO_ITEMS_K2_ID');
//            } else {
//                $error = \JText::_('MOD_EFFECT_CONTENT_K2_NOT_INSTALLED');
//            }
//        } else {
//            require_once(JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php');
//        }
//        break;
//    }
//    case 'categories_adsmanager' :
//    {
//        if (!count($list)) {
//            if (\JFile::exists(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_adsmanager' . DS . 'adsmanager.php')) {
//                $error = \JText::_('MOD_EFFECT_CONTENT_NO_CATEGORIES_ADSMANAGER');
//            } else {
//                $error = \JText::_('MOD_EFFECT_CONTENT_ADSMANAGER_NOT_INSTALLED');
//            }
//        } else {
//            require_once(JPATH_SITE . DS . 'components' . DS . 'com_adsmanager' . DS . 'lib' . DS . 'core.php');
//        }
//        break;
//    }
//    case 'ads_adsmanager' :
//    {
//        if (!count($list)) {
//            if (\JFile::exists(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_adsmanager' . DS . 'adsmanager.php')) {
//                $error = \JText::_('MOD_EFFECT_CONTENT_NO_ADS_ADSMANAGER');
//            } else {
//                $error = \JText::_('MOD_EFFECT_CONTENT_ADSMANAGER_NOT_INSTALLED');
//            }
//        } else {
//            require_once(JPATH_SITE . DS . 'components' . DS . 'com_adsmanager' . DS . 'lib' . DS . 'core.php');
//        }
//        break;
//    }
//    case 'ads_adsmanager_id' :
//    {
//        if (!count($list)) {
//            if (\JFile::exists(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_adsmanager' . DS . 'adsmanager.php')) {
//                $error = \JText::_('MOD_EFFECT_CONTENT_NO_ADS_ADSMANAGER_ID');
//            } else {
//                $error = \JText::_('MOD_EFFECT_CONTENT_ADSMANAGER_NOT_INSTALLED');
//            }
//        } else {
//            require_once(JPATH_SITE . DS . 'components' . DS . 'com_adsmanager' . DS . 'lib' . DS . 'core.php');
//        }
//        break;
//    }
}

if ($params->get('decimal_count')) {
    $decimal_count = $params->get('decimal_count');
} else {
    $decimal_count = 0;
}
if ($params->get('decimal_symbol')) {
    $decimal_symbol = $params->get('decimal_symbol');
} else {
    $decimal_symbol = '.';
}
if ($params->get('thousand_separator')) {
    $thousand_separator = $params->get('thousand_separator');
} else {
    $thousand_separator = '';
}

if (!isset($error)) {
    ?>
    <div id="module_effect_contents_<?php echo $module->id; ?>"
         class="list_contents <?php echo $params->get('moduleclass_sfx'); ?>">
        <?php if ($params->get('text_start') != '') { ?>
            <div class="description_start"><?php echo $params->get('text_start'); ?></div>
        <?php } ?>

        <?php
        $i = 0;
        $pages_count = 0;
        $pages = 0;
        $image_not_found = $params->get('image_not_found') !== '' ? HTMLHelper::_('cleanImageURL', $params->get('image_not_found'))->url : '';
        foreach ($list as $id) {
            // Готовим картинку
            if ($params->get('display_image') == '1') {
                if ($params->get('layout') == 'categories_joomla') {
                    switch ($params->get('joomla_image_from')) {
                        case '0':
                        {
                            if (preg_match('@<img([^>]+)>@ui', $id->text, $images)) {
                                if (preg_match('@src="([^"]+)"@ui', $images[0], $images)) {
                                    if (\JFile::exists(JPATH_BASE . DS . $images[1])) {
                                        $image = $images[1];
                                    } else {
                                        if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
                                            $image = $image_not_found;
                                        } else {
                                            unset($image);
                                        }
                                    }
                                } else {
                                    if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
                                        $image = $image_not_found;
                                    } else {
                                        unset($image);
                                    }
                                }
                            } else {
                                if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
                                    $image = $image_not_found;
                                } else {
                                    unset($image);
                                }
                            }
                            break;
                        }
                        case '1':
                        case '2':
                        {
                            $image = json_decode($id->params, true);
                            if ($image['image'] != '' && \JFile::exists(JPATH_BASE . DS . HTMLHelper::_('cleanImageURL', $image['image'])->url)) {
                                $image = HTMLHelper::_('cleanImageURL', $image['image'])->url;
                            } else {
                                if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
                                    $image = $image_not_found;
                                } else {
                                    unset($image);
                                }
                            }
                            break;
                        }
                    }
                }

                if ($params->get('layout') == 'articles_joomla' || $params->get('layout') == 'articles_joomla_id') {
                    switch ($params->get('joomla_image_from')) {
                        case '0':
                        {
                            if (preg_match('@<img([^>]+)>@ui', $id->introtext, $images)) {
                                if (preg_match('@src="([^"]+)"@ui', $images[0], $images)) {
                                    if (\JFile::exists(JPATH_BASE . DS . $images[1])) {
                                        $image = $images[1];
                                    } else {
                                        if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
                                            $image = $image_not_found;
                                        } else {
                                            unset($image);
                                        }
                                    }
                                } else {
                                    if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
                                        $image = $image_not_found;
                                    } else {
                                        unset($image);
                                    }
                                }
                            } else {
                                if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
                                    $image = $image_not_found;
                                } else {
                                    unset($image);
                                }
                            }
                            break;
                        }
                        case '1':
                        {
                            $image = json_decode($id->images, true);
                            if ($image['image_intro'] != '' && \JFile::exists(JPATH_BASE . DS . HTMLHelper::_('cleanImageURL', $image['image_intro'])->url)) {
                                $image = HTMLHelper::_('cleanImageURL', $image['image_intro'])->url;
                            } else {
                                if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
                                    $image = $image_not_found;
                                } else {
                                    unset($image);
                                }
                            }
                            break;
                        }
                        case '2':
                        {
                            $image = json_decode($id->images, true);
                            if ($image['image_fulltext'] != '' && \JFile::exists(JPATH_BASE . DS . HTMLHelper::_('cleanImageURL', $image['image_fulltext'])->url)) {
                                $image = HTMLHelper::_('cleanImageURL', $image['image_fulltext'])->url;
                            } else {
                                if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
                                    $image = $image_not_found;
                                } else {
                                    unset($image);
                                }
                            }
                            break;
                        }
                    }
                }
                if ($params->get('layout') == 'categories_joomshopping') {
                    if (\JFile::exists(JPATH_BASE . DS . 'components' . DS . 'com_jshopping' . DS . 'files' . DS . 'img_categories' . DS . $id->image)) {
                        $image = 'components' . DS . 'com_jshopping' . DS . 'files' . DS . 'img_categories' . DS . $id->image;
                    } else {
                        if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
                            $image = $image_not_found;
                        } else {
                            unset($image);
                        }
                    }
                }

                if ($params->get('layout') == 'products_joomshopping' || $params->get('layout') == 'products_joomshopping_id') {
                    if (\JFile::exists(JPATH_BASE . DS . 'components' . DS . 'com_jshopping' . DS . 'files' . DS . 'img_products' . DS . $id->image)) {
                        $image = 'components' . DS . 'com_jshopping' . DS . 'files' . DS . 'img_products' . DS . $id->image;
                    } else {
                        if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
                            $image = $image_not_found;
                        } else {
                            unset($image);
                        }
                    }
                }
//                if ($params->get('layout') == 'categories_k2') {
//                    if (\JFile::exists(JPATH_BASE . DS . 'media' . DS . 'k2' . DS . 'categories' . DS . $id->image)) {
//                        $image = 'media' . DS . 'k2' . DS . 'categories' . DS . $id->image;
//                    } else {
//                        if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
//                            $image = $image_not_found;
//                        } else {
//                            unset($image);
//                        }
//                    }
//                }
//                if ($params->get('layout') == 'items_k2' || $params->get('layout') == 'items_k2_id') {
//                    if (\JFile::exists(JPATH_BASE . DS . 'media' . DS . 'k2' . DS . 'items' . DS . 'cache' . DS . md5('Image' . $id->id) . '_L.jpg')) {
//                        $image = 'media' . DS . 'k2' . DS . 'items' . DS . 'cache' . DS . md5('Image' . $id->id) . '_L.jpg';
//                    } else {
//                        if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
//                            $image = $image_not_found;
//                        } else {
//                            unset($image);
//                        }
//                    }
//                }
//                if ($params->get('layout') == 'categories_adsmanager') {
//                    if (\JFile::exists(JPATH_BASE . DS . 'images' . DS . 'com_adsmanager' . DS . 'categories' . DS . basename(TTools::getCatImageUrl($id->id, false)))) {
//                        $image = TTools::getCatImageUrl($id->id, false);
//                    } else {
//                        if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
//                            $image = $image_not_found;
//                        } else {
//                            unset($image);
//                        }
//                    }
//                }
//                if ($params->get('layout') == 'ads_adsmanager' || $params->get('layout') == 'ads_adsmanager_id') {
//                    $image = json_decode($id->image, true);
//                    $image = $image[0];
//                    if (\JFile::exists(JPATH_BASE . DS . 'images' . DS . 'com_adsmanager' . DS . 'contents' . DS . $image['image'])) {
//                        $image = JURI_IMAGES_FOLDER . '/' . $image['image'];
//                    } else {
//                        if ($image_not_found != '' && \JFile::exists(JPATH_BASE . DS . $image_not_found)) {
//                            $image = $image_not_found;
//                        } else {
//                            unset($image);
//                        }
//                    }
//                }
            }

            // Готовим описание
            if ($params->get('display_description') == '1') {
                if ($params->get('layout') == 'articles_joomla' || $params->get('layout') == 'articles_joomla_id') {
                    switch ($params->get('joomla_desc_from')) {
                        case '0':
                        {
                            $description = mb_substr(strip_tags($id->introtext), 0, $params->get('symbol_count')) . $params->get('end_symbol');
                            break;
                        }
                        case '1':
                        {
                            $description = mb_substr(strip_tags($id->fulltext), 0, $params->get('symbol_count')) . $params->get('end_symbol');
                            break;
                        }
                        case '2':
                        {
                            $description = mb_substr(strip_tags($id->metadesc), 0, $params->get('symbol_count')) . $params->get('end_symbol');
                            break;
                        }
                    }
                } else {
                    $description = mb_substr(strip_tags($id->text), 0, $params->get('symbol_count')) . $params->get('end_symbol');
                }
            }

            // Готовим ссылку
            if ($params->get('layout') == 'categories_joomla') {
                $link = Route::_(RouteHelper::getCategoryRoute($id->id));
            }
            if ($params->get('layout') == 'articles_joomla' || $params->get('layout') == 'articles_joomla_id') {
                $link = Route::_(RouteHelper::getArticleRoute($id->id, $id->catid));
            }
            if ($params->get('layout') == 'categories_joomshopping') {
                $link = \JSHelper::SEFLink('index.php?option=com_jshopping&controller=category&task=view&category_id=' . $id->id, 1);
            }
            if ($params->get('layout') == 'products_joomshopping' || $params->get('layout') == 'products_joomshopping_id') {
                $link = \JSHelper::SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id=' . $id->category_id . '&product_id=' . $id->id, 1);
            }
//            if ($params->get('layout') == 'categories_k2') {
//                $link = \JRoute::_(K2HelperRoute::getCategoryRoute($id->id . ':' . $id->alias));
//            }
//            if ($params->get('layout') == 'items_k2' || $params->get('layout') == 'items_k2_id') {
//                $link = \JRoute::_(K2HelperRoute::getItemRoute($id->id . ':' . $id->alias, $id->catid . ':' . $id->cat_alias));
//            }
//            if ($params->get('layout') == 'categories_adsmanager') {
//                $link = TRoute::_('index.php?option=com_adsmanager&view=list&catid=' . $id->id);
//            }
//            if ($params->get('layout') == 'ads_adsmanager' || $params->get('layout') == 'ads_adsmanager_id') {
//                $link = TRoute::_('index.php?option=com_adsmanager&view=details&id=' . $id->id . '&catid=' . $id->catid);
//            }

            // Готовим цену
            if ($params->get('display_price') == '1' && (isset($id->product_price))) {
                $price = number_format($id->product_price, $decimal_count, $decimal_symbol, $thousand_separator) . ' ' . $id->currency_code;
            }

            if ($params->get('pages_count') > 0 && ($pages_count == 0 || ($pages_count % $params->get('pages_count') == 0))) {
                $pages++;
                echo '<div class="page_content block_page_' . $pages . (($pages == 1) ? ' active' : '') . '">';
            }
            $pages_count++;
            $i++;
            ?>

            <div class="view style<?php echo $params->get('type_style'); ?>">
                <?php if ($params->get('link_all') == '1') { ?>
                <a href="<?php echo $link; ?>">
                    <?php } ?>
                    <?php if (isset($image) && $image != '' && $params->get('display_image') == '1') { ?>
                        <img src="<?php echo $image; ?>" alt="<?php echo $id->title; ?>"/>
                    <?php } ?>
                    <div class="mask">
                        <h2><?php
                            if ((int)$params->get('title_symbol_count') > 0) {
                                echo mb_substr($id->title, 0, $params->get('title_symbol_count'));
                            } else {
                                echo $id->title;
                            } ?></h2>
                        <?php if ($params->get('display_description') == '1') { ?>
                            <p><?php echo $description; ?></p>
                        <?php } ?>

                        <?php if ($params->get('display_price') == '1' && (isset($price))) { ?>
                            <span class="price"><?php echo $price; ?></span>
                        <?php } ?>

                        <?php
                        if ($params->get('show_date') == '1' && $params->get('date_format') != '') {
                            $date_publish = strtotime($id->date_publish);
                            ?>
                            <span class="date"><?php echo date($params->get('date_format'), $date_publish); ?></span>
                        <?php } ?>

                        <?php if ($params->get('display_read_more') == '1') { ?>
                            <?php if ($params->get('link_all') == '0') { ?>
                                <a href="<?php echo $link; ?>"
                                   class="readmore"><?php echo $params->get("read_more"); ?></a>
                            <?php } else { ?>
                                <span class="readmore"><?php echo $params->get("read_more"); ?></span>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <?php if ($params->get('link_all') == '1') { ?>
                </a>
            <?php } ?>
            </div>
            <?php
            if ($params->get('pages_count') > 0 && ($pages_count == count($list) || $pages_count % $params->get('pages_count') == 0)) {
                echo '</div>';
            }
        }
        ?>

        <?php if ($params->get('pages_count') > 0 && $pages > 0) { ?>
            <div class="p-paginations">
                <?php for ($j = 1; $j <= $pages; $j++) { ?>
                    <span class="p-page<?php if ($j == 1) {
                        echo ' current';
                    } ?>" data-page="page_<?php echo $j; ?>"><?php echo $j; ?></span>
                <?php } ?>
            </div>
            <div class="clear"></div>
        <?php } ?>

        <?php if ($params->get('text_end') != '') { ?>
            <div class="description_end"><?php echo $params->get('text_end'); ?></div>
        <?php } ?>
    </div>

    <?php
} else {
    echo $error;
}