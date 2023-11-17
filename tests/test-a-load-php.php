<?php

/**
 * @package gbcptedit
 * @copyright (C) Copyright Bobbing Wide 2023
 *
 * Unit tests to load all the files for PHP 8.2, except batch ones
 */

class Tests_load_libs extends BW_UnitTestCase
{

	/**
	 * set up logic
	 *
	 * - ensure any database updates are rolled back
	 * - we need oik-googlemap to load the functions we're testing
	 */
	function setUp(): void
	{
		parent::setUp();

	}

	/**
	 * Test that the plugin is loaded
	 */
	function test_load_plugin() {
		oik_require( 'gbcptedit.php', 'gbcptedit');
		$this->assertTrue( true );
	}

}