<?php

/**
 * This file is part of the Liquid package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Liquid
 */

namespace Insales;

/**
 * A selection of extended filters.
 */
class ExtFilters
{

	/**
	 * Return <a> tag
	 *
	 * @param string $link
	 * @param string $url
	 * @param string $title
	 * @return string
	 */
	public static function link_to($link, $url, $title = '') {
		return '<a href="'.$url.'" title="'.$title.'">'.$link.'</a>';
	}

	/**
	 * Return default pagination
	 *
	 * @param array $input
	 * @return string
	 */
	public static function default_pagination($input) {
		$html = '';
		if (isset($input['previous'])) {
			$html .= '<span class="prev">'.self::link_to($input['previous']['title'], $input['previous']['url']).'</span>';
		}
		foreach ($input['parts'] as $part) {
			if ($part['is_link']) {
				$html .= '<span class="page pagination_page ">'.self::link_to($part['title'], $part['url']).'</span>';
			} else if (strtolower ($part['title']) === strtolower ($input['current_page'])) {
				$html .= '<span class="page pagination_page current">'.$part['title'].'</span>';
			} else {
				$html .= '<span class="decot">'.$part['title'].'</span>';
			}
		}

		if (isset($input['next'])) {
			$html .= '<span class="next">'.self::link_to($input['next']['title'], $input['next']['url']).'</span>';
		}
		return $html;
	}

	/**
	 * Return json
	 *
	 * @param mixed $input
	 * @return string
	 */
	public static function json($input) {
		return json_encode($input);
	}

	/**
	 * Return <option> tag
	 *
	 * @param string $value value attribute
	 * @param boolean $selected [optional] is selected or not
	 * @param string $title [optional] string to inner
	 * @return string
	 */
	public static function select_option($value, $selected = false, $title = '') {

		return
			sprintf('<option %s value="%s">%s</option>',
					(($selected)?'selected':''),
					$value,
					$title
				);
	}
	
	/**
	 * Return url to shopify asset
	 * 
	 * @param string $value
	 * @return string
	 */
	public static function shopify_asset_url($value) {
		return $value;
	}
	
	/**
	 * Return <script> wrap for string
	 * 
	 * @param string $src source url for script
	 * @return string
	 */
	public static function script_tag($src) {
		return sprintf('<script src="%s"></script>', $src);
	}
	
	/**
	 * Return language string from lang file, lang file shoud be added at
	 * \Liquid\Liquid::$config LANG_FILE key
	 * 
	 * @param string $fullname full name of string
	 * @return sting
	 */
	public static function t($fullname) {
		$lang = \Liquid\Liquid::get('LANG_FILE');
		if (is_null($lang)) {
			return '';
		}
		
		$res = $lang;
		foreach(explode('.', $fullname) as $name) {
			if (isset($res[$name])) {
				$res = $res[$name];
			} else {
				$res = null;
			}
		}
		return is_string($res)?$res:'Not found - '.$fullname;
		
	}
}
