<?php

namespace WPMedia\Options\Tests\Unit\SiteOptions;

use Brain\Monkey\Functions;
use WPMedia\Options\SiteOptions;
use WPMedia\Options\Tests\Unit\TestCase;

/**
 * @covers WPMedia\Options\SiteOptions::get
 * @group SiteOptions
 */
class Test_Get extends TestCase {

	public function testShouldReturnDefaultWhenOptionDoesntExist() {
		$options = new SiteOptions( 'wpmedia_options_' );

		$data = [
			'test1' => null,
			'test2' => false,
			'test3' => 'off',
		];
		foreach( $data as $name => $default ) {
			Functions\expect( 'get_site_option' )
				->once()
				->with( "wpmedia_options_{$name}", $default )
				->andReturn( $default );

			$this->assertSame( $default, $options->get( $name, $default ) );
		}
	}

	public function testShouldReturnOptionWhenExists() {
		$options = new SiteOptions( 'wpmedia_options_' );

		$data = [
			'test1' => 'some value',
			'test2' => 'off',
			'test3' => [
				'setting1' => 'some value',
				'setting2' => 1,
			],
		];

		foreach( $data as $name => $value ) {
			Functions\expect( 'get_site_option' )
				->once()
				->with( "wpmedia_options_{$name}", null )
				->andReturn( $value );

			$this->assertSame( $value, $options->get( $name ) );
		}
	}
}