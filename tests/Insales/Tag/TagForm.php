<?php

/**
 * This file is part of the Liquid/Insales package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Insales
 */

namespace Insales\Tag;

class TagPaginateTest extends \Insales\TestCase
{
	/**
	 * @expectedException \Liquid\LiquidException
	 */
	public function testSyntaxError() {
		$this->assertTemplateResult('', '{% form %}');
	}

	public function testCreateBlock() {
		$this->assertTemplateResult('block content', '{% form foo %}block content{% endform %}');
	}
}
