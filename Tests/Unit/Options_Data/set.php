<?php

namespace WPMedia\Options\Tests\Unit\Options_Data;

use WP_Rocket\Admin\Options_Data;
use WPMedia\Options\Tests\Unit\TestCase;

/**
 * @covers WP_Rocket\Admin\Options_Data::set
 * @group  OptionsData
 */
class Test_Set extends TestCase {
	private static $data = [
		'test1' => 'some value',
		'test2' => 'off',
		'test3' => [
			'setting1' => 'some value',
			'setting2' => 1,
		],
	];

	public function testShouldAddOptionWhenDoesntExist() {
		$options = new Options_Data( [] );

		foreach ( self::$data as $key => $value ) {
			$this->assertFalse( $options->has( $key ) );
			$options->set( $key, $value );
			$this->assertTrue( $options->has( $key ) );
			$this->assertSame( $value, $options->get( $key ) );
		}
	}

	public function testShouldOverrideOptionWhenExists() {
		$options = new Options_Data( self::$data );

		foreach ( self::$data as $key => $value ) {
			$new_value = $key;
			$this->assertTrue( $options->has( $key ) );
			$options->set( $key, $new_value );
			$this->assertTrue( $options->has( $key ) );
			$this->assertSame( $new_value, $options->get( $key ) );
		}
	}
}
