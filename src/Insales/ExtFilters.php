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
				$html .= '<span class="page">'.self::link_to($part['title'], $part['url']).'</span>';
			} else if (strtolower ($part['title']) === strtolower ($input['current_page'])) {
				$html .= '<span class="page current">'.$part['title'].'</span>';
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
}
