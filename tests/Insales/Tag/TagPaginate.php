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

use Insales\TestCase;

class TagPaginateTest extends TestCase
{
	/**
	 * @expectedException \Liquid\LiquidException
	 */
	public function testSyntaxError() {
		$this->assertTemplateResult('', '{% paginate %}');
	}

	public function testCreateBlock() {
		$this->assertTemplateResult('block content', '{% paginate foo %}block content{% endpaginate %}');
	}
}
