<?php
namespace Insales;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-04-01 at 15:50:49.
 */
class ExtFiltersTest extends \Liquid\TestCase
{
    /**
     * @var \Liquid\Context
     */
    protected $context;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
		parent::setUp();

		$this->context = new \Liquid\Context();

		$this->context->addFilters('\Insales\ExtFilters');
		
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Insales\ExtFilters::link_to
     */
    public function testLink_to()
    {
        $data = [
			'<a href="href://asd" title="">asd</a>' => ['asd', 'href://asd'],
			'<a href="href://asd" title="title">asd</a>' => ['asd', 'href://asd', 'title'],
		];

		foreach ($data as $expected => $element) {
			$this->assertEquals($expected, call_user_func_array(__NAMESPACE__ .'\ExtFilters::link_to', $element));
		}
    }

    /**
     * @covers Insales\ExtFilters::default_pagination
     */
    public function testDefault_pagination()
    {
        $expected = '<span class="page current">1</span><span class="page"><a href="/blog?page=2" title="">2</a></span><span class="next"><a href="/blog?page=2" title="">&raquo;</a></span>';
		$paginate = [
			"page_size" => 10,
			"current_page" => 1,
			"current_offset" => 0,
			"items" => 19,
			"pages" => 2,
			"next" => [
				"title" => "&raquo;",
				"url" => "/blog?page=2",
				"is_link" => true
			],
			"parts" => [
				[
					"title" => 1,
					"is_link" => false
				],
				[
					"title" => 2,
					"url" => "/blog?page=2",
					"is_link" => true
				]
			]
		];
		$this->assertEquals($expected, ExtFilters::default_pagination($paginate));
    }

    /**
     * @covers Insales\ExtFilters::json
     */
    public function testJson()
    {
        $data = [
			'{"asd":"test"}' => (object)['asd' => 'test'],
		];

		foreach ($data as $expected => $element) {
			$this->assertEquals($expected, ExtFilters::json($element));
		}
    }

	/**
	 * @covers \Insales\ExtFilters::select_option
	 */
	public function testSelect_option() {
		$data = [
			'<option  value=""></option>' => [''],
			'<option  value="value">title</option>' => ['value', false, 'title'],
			'<option selected value="value2">title2</option>' => ['value2', true, 'title2'],
		];

		foreach ($data as $expected => $element) {
			$this->assertEquals($expected, call_user_func_array(__NAMESPACE__ .'\ExtFilters::select_option', $element));
		}
	}
	
	/**
	 * @covers \Insales\ExtFilters::shopify_asset_url
	 */
	public function testShopify_asset_url() {
		$data = [
			'test' => 'test',
		];

		foreach ($data as $expected => $element) {
			$this->assertEquals($expected, ExtFilters::shopify_asset_url($element));
		}
	}
	
	/**
	 * @covers \Insales\ExtFilters::script_tag
	 */
	public function testScript_tag() {
		$data = [
			'<script src="arg"></script>' => 'arg',
		];

		foreach ($data as $expected => $element) {
			$this->assertEquals($expected, ExtFilters::script_tag($element));
		}
	}
	
	/**
	 * @covers \Insales\ExtFilters::t
	 */
	public function testT() {
		$lang = [
			'general' => [
				'my' => 'text'
			]
		];
		\Liquid\Liquid::set('LANG_FILE', $lang);
		
		$data = [
			'text' => 'general.my',
			'Not found - general' => 'general',
			'Not found - qwerty' => 'qwerty'
		];

		foreach ($data as $expected => $element) {
			$this->assertEquals($expected, ExtFilters::t($element));
		}
	}
}
