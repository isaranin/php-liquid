<?php

/**
 * This file is part of the Liquid package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Liquid
 */

$loader = require __DIR__ . '/../autoload.php';

class TestAutoLoader {

    public static function loadClass($className) {
        $parts = explode('\\', ltrim($className,"\\"));
		$full = __DIR__ . "/" . implode("/", $parts) . ".php";
		if(file_exists($full)){
			require_once $full;
		}
     }

}

spl_autoload_register(array('TestAutoLoader', 'loadClass'));
