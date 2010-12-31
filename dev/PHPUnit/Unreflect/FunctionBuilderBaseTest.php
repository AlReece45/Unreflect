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
 * @see Unreflect_FunctionBuilderBase
 */
class Test_Unreflect_FunctionBuilderBaseTest
	extends Test_Unreflect_TestCase
{
	/**
	 * @return Test_Unreflect_FunctionBuilderBase_Mock
	 */
	protected function _getInstance()
	{
		$return = new Test_Unreflect_FunctionBuilderBase_Mock();
		return $return;
	}

	/**
	 * Tests to make sure that the class exists
	 */
	function testInstance()
	{
		$this->assertClassExists('Unreflect_FunctionBuilderBase');
		$this->assertClassExists('Test_Unreflect_FunctionBuilderBase_Mock');
		$instance = new Test_Unreflect_FunctionBuilderBase_Mock();
	}

	/**
	 * @depends testInstance
	 */
	function testAddParameter()
	{
		$this->assertClassExists('Unreflect_ParameterBuilder');
		$function = $this->_getInstance();
		$function->addParameter(new Unreflect_ParameterBuilder());
	}

	/**
	 * @depends testInstance
	 */
	function testGetBodyDefault()
	{
		$function = $this->_getInstance();
		$this->assertEquals('', $function->getBody());
	}

	/**
	 * @depends testInstance
	 */
	function testGetDescriptionDefault()
	{
		$function = $this->_getInstance();
		$this->assertEquals('', $function->getDescription());
	}

	/**
	 * @depends testInstance
	 */
	function testGetDocumentation()
	{
		$expected = "\n/**\n */\n";
		$function = $this->_getInstance();
		$this->assertEquals($expected, $function->getDocumentation());
	}

	/**
	 * @depends testInstance
	 */
	function testGetNameDefault()
	{
		$function = $this->_getInstance();
		$this->assertEquals('', $function->getName());
	}

	/**
	 * @depends testInstance
	 */
	function testGetParameter()
	{
		$function = $this->_getInstance();
		$return = $function->getParameter('testParameter');
		$this->assertType('Unreflect_ParameterBuilder', $return);
		$this->assertEquals('testParameter', $return->getName());
	}

	/**
	 * @depends testInstance
	 */
	function testGetTypeDefault()
	{
		$function = $this->_getInstance();
		$this->assertEquals('', $function->getType());
	}

	/**
	 * @depends testInstance
	 */
	function testGetParametersEmpty()
	{
		$function = $this->_getInstance();
		$return = $function->getParameters();
		$this->assertTraversable($return);
		$this->assertEquals(0, count($return));
	}

	/**
	 * @depends testInstance
	 */
	function testSetBody()
	{
		$function = $this->_getInstance();
		$this->assertSame($function, $function->setBody('return "fun"'));
	}

	/**
	 * @depends testInstance
	 */
	function testSetDescription()
	{
		$function = $this->_getInstance();
		$this->assertSame($function, $function->setDescription('This is a description"'));
	}

	/**
	 * @depends testInstance
	 */
	function testSetName()
	{
		$function = $this->_getInstance();
		$this->assertSame($function, $function->setName('testFunction'));
	}

	/**
	 * @depends testInstance
	 */
	function testSetType()
	{
		$function = $this->_getInstance();
		$this->assertSame($function, $function->setType('Mixed'));
	}

	/**
	 * @depends testAddParameter
	 */
	function testGetAddedParameters()
	{
		$parameter = new Unreflect_ParameterBuilder();
		$function = $this->_getInstance();
		$function->addParameter($parameter);
		$return = $function->getParameters();
		$this->assertTraversable($return);
		$this->assertEquals(1, count($return));
		$this->assertSame($parameter, reset($return));
	}

	/**
	 * @depends testAddParameter
	 */
	function testGetParamtizedDocumentation()
	{
		$expected = '
/**
 * @param Mixed $test
 */
';
		$function = $this->_getInstance();
		$function->addParameter($function->getParameter('test'));
		$this->assertEquals($expected, $function->getDocumentation());
	}

	/**
	 * @depends testSetBody
	 */
	function testGetSetBody()
	{
		$expected = 'return "fun"';
		$function = $this->_getInstance();
		$function->setBody($expected);
		$this->assertEquals($expected, $function->getBody());
	}

	/**
	 * @depends testAddParameter
	 */
	function testGetDescripbedDocumentation()
	{
		$expected = '
/**
 * This is where
 * 
 * a multi-line description goes.
 */
';
		$description = "This is where\n\na multi-line description goes.";
		$function = $this->_getInstance();
		$function->setDescription($description);
		$this->assertEquals($expected, $function->getDocumentation());
	}

	/**
	 * @depends testSetDescription
	 */
	function testGetSetDescription()
	{
		$expected = 'This is a test description';
		$function = $this->_getInstance();
		$function->setDescription($expected);
		$this->assertEquals($expected, $function->getDescription());
	}

	/**
	 * @depends testSetName
	 */
	function testGetSetName()
	{
		$expected = 'testName';
		$function = $this->_getInstance();
		$function->setName($expected);
		$this->assertEquals($expected, $function->getName());
	}

	/**
	 * @depends testSetName
	 */
	function testGetDefinition()
	{
		$expected = 'function testName()';
		$function = $this->_getInstance();
		$function->setName('testName');
		$this->assertEquals($expected, $function->getDefinition());
	}

	/**
	 * @depends testSetType
	 */
	function testGetTypedDocumentation()
	{
		$expected = '
/**
 * @return Mixed
 */
';
		$function = $this->_getInstance();
		$function->setType('Mixed');
		$this->assertEquals($expected, $function->getDocumentation());
	}

	/**
	 * @depends testGetParameter
	 * @depends testSetName
	 */
	function testGetDefinitionParameter()
	{
		$expected = 'function testName($test)';
		$function = $this->_getInstance();
		$function->setName('testName');
		$function->addParameter($function->getParameter('test'));
		$this->assertEquals($expected, $function->getDefinition());
	}

	/**
	 * @depends testGetParameter
	 * @depends testSetName
	 */
	function testGetDefinitionParameters()
	{
		$expected = 'function testName($test, $test2)';
		$function = $this->_getInstance();
		$function->setName('testName');
		$function->addParameter($function->getParameter('test'));
		$function->addParameter($function->getParameter('test2'));
		$this->assertEquals($expected, $function->getDefinition());
	}
}