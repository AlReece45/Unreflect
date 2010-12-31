<?php
/*
 * Unreflect Library Tests
 * Copyright 2010 Alexander Reece
 * Licensed under: GNU Lesser Public License 2.1 or later
 */
/**
 * @author Alexander Reece <AlReece45@gmail.com>
 * @copyright 2010 (c) Alexander Reece
 * @license http://www.opensource.org/licenses/lgpl-2.1.php
 * @package Test_Unreflect
 */
require_once 'Unreflect/TestCase.php';

/**
 * @see Unreflect_FunctionBuilder
 */
class Test_Unreflect_FunctionBuilderTest
	extends Test_Unreflect_TestCase
{
	/**
	 * @return Unreflect_FunctionBuilder
	 */
	protected function _getInstance()
	{
		$return = new Unreflect_FunctionBuilder();
		return $return;
	}

	/**
	 * Test to ensure the class exists and initilizes correctly
	 */
	function testInstance()
	{
		$this->assertClassExists('Unreflect_FunctionBuilder');
		$instance = new Unreflect_FunctionBuilder();
	}

	/**
	 * @depends testInstance
	 */
	function testExport()
	{
		$expected = '
/**
 * @return String
 */
function testFunction()
{
	return "Happy Hour";
}
';
		$function = $this->_getInstance();
		$function->setType('String');
		$function->setName('testFunction');
		$function->setBody('return "Happy Hour";');
		$this->assertEquals($expected, $function->export());
	}
}