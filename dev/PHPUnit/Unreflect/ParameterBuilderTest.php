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
 * @see Unreflect_Parameter_Default
 */
class Test_Unreflect_Parameter_DefaultTest
	extends Test_Unreflect_TestCase
{
	/**
	 * @return Unreflect_ParameterBuilder
	 */
	protected function _getInstance()
	{
		$return = new Unreflect_ParameterBuilder();
		return $return;
	}

	/**
	 * Tests to make sure that the class exists
	 */
	function testInstance()
	{
		$this->assertClassExists('Unreflect_ParameterBuilder');
		$instance = new Unreflect_ParameterBuilder();
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultDefault()
	{
		$parameter = $this->_getInstance();
		$this->assertEquals('', $parameter->getDefault());
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultDescription()
	{
		$parameter = $this->_getInstance();
		$this->assertEquals('', $parameter->getDescription());
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultName()
	{
		$parameter = $this->_getInstance();
		$this->assertEquals('', $parameter->getName());
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultType()
	{
		$parameter = $this->_getInstance();
		$this->assertEquals('Mixed', $parameter->getType());
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultTypeHint()
	{
		$parameter = $this->_getInstance();
		$this->assertEquals('', $parameter->getTypeHint());
	}

	/**
	 * @depends testInstance
	 */
	function testSetDefault()
	{
		$parameter = $this->_getInstance();
		$this->assertSame($parameter, $parameter->setDefault('testDefault'));
	}

	/**
	 * @depends testInstance
	 */
	function testSetDescription()
	{
		$parameter = $this->_getInstance();
		$this->assertSame($parameter, $parameter->setDescription('test'));
	}

	/**
	 * @depends testInstance
	 */
	function testSetName()
	{
		$parameter = $this->_getInstance();
		$this->assertSame($parameter, $parameter->setName('testName'));
	}

	/**
	 * @depends testInstance
	 */
	function testSetType()
	{
		$parameter = $this->_getInstance();
		$this->assertSame($parameter, $parameter->setType('Test_Type'));
	}

	/**
	 * @depends testInstance
	 */
	function testSetTypeHint()
	{
		$parameter = $this->_getInstance();
		$this->assertSame($parameter, $parameter->setTypeHint('testDefault'));
	}

	/**
	 * @depends testSetDefault
	 */
	function testGetSetDefault()
	{
		$parameter = $this->_getInstance();
		$default = 'testDefault';
		$expected = var_export($default, true);
		$parameter->setDefault($default);
		$this->assertEquals($expected, $parameter->getDefault());
	}

	/**
	 * @depends testSetName
	 */
	function testExport()
	{
		$parameter = $this->_getInstance();
		$parameter->setName('testVariable');
		$this->assertSame('$testVariable', $parameter->export());
	}

	/**
	 * @depends testSetName
	 */
	function testGetDocumentation()
	{
		$expected = '@param Mixed $testName';
		$parameter = $this->_getInstance();
		$parameter->setName('testName');
		$this->assertEquals($expected, $parameter->getDocumentation());
	}

	/**
	 * @depends testSetName
	 */
	function testGetSetName()
	{
		$parameter = $this->_getInstance();
		$parameter->setName('testName023');
		$this->assertEquals('testName023', $parameter->getName());
	}

	/**
	 * @depends testSetType
	 */
	function testGetSetType()
	{
		$parameter = $this->_getInstance();
		$parameter->setType('ABC_DEF');
		$this->assertEquals('ABC_DEF', $parameter->getType());
	}

	/**
	 * @depends testSetTypeHint
	 */
	function testSyncronizedTypeHint()
	{
		$parameter = $this->_getInstance();
		$parameter->setTypeHint('ABC_DEF');
		$this->assertEquals('ABC_DEF', $parameter->getType());
	}

	/**
	 * @depends testSetDescription
	 */
	function testGetSetDescription()
	{
		$parameter = $this->_getInstance();
		$expected = 'Test Description';
		$parameter->setDescription($expected);
		$this->assertEquals($expected, $parameter->getDescription());
	}

	/**
	 * @depends testSetTypeHint
	 */
	function testGetSetTypeHint()
	{
		$parameter = $this->_getInstance();
		$parameter->setTypeHint('ABC_DEF');
		$this->assertEquals('ABC_DEF', $parameter->getTypeHint());
	}

	/**
	 * @depends testSetName
	 * @depends testSetTypeHint
	 */
	function testExportTypeHint()
	{
		$parameter = $this->_getInstance();
		$parameter->setName('testVariable');
		$parameter->setTypeHint('TestType');
		$this->assertSame('TestType $testVariable', $parameter->export());
	}

	/**
	 * @depends testSetName
	 * @depends testSetDescription
	 */
	function testGetDocumentationDescription()
	{
		$expected = '@param Mixed $testName This is a description';
		$parameter = $this->_getInstance();
		$parameter->setName('testName');
		$parameter->setDescription('This is a description');
		$this->assertEquals($expected, $parameter->getDocumentation());
	}

	/**
	 * @depends testSetName
	 * @depends testSetType
	 */
	function testGetDocumentationEmptyType()
	{
		$expected = '@param Mixed $testName';
		$parameter = $this->_getInstance();
		$parameter->setName('testName');
		$parameter->setType('');
		$this->assertEquals($expected, $parameter->getDocumentation());
	}

	/**
	 * @depends testSetName
	 * @depends testSetType
	 */
	function testGetDocumentationType()
	{
		$expected = '@param Test_Type $testName';
		$parameter = $this->_getInstance();
		$parameter->setName('testName');
		$parameter->setType('Test_Type');
		$this->assertEquals($expected, $parameter->getDocumentation());
	}

	/**
	 * @depends testSetName
	 * @depends testSetTypeHint
	 */
	function testGetDocumentationTypeHint()
	{
		$expected = '@param Test_Type $testName';
		$parameter = $this->_getInstance();
		$parameter->setName('testName');
		$parameter->setTypeHint('Test_Type');
		$this->assertEquals($expected, $parameter->getDocumentation());
	}

	/**
	 * @depends testSetName
	 * @depends testSetDescription
	 */
	function testGetDocumentationDescriptionType()
	{
		$expected = '@param Test_Type $testName This is a description';
		$parameter = $this->_getInstance();
		$parameter->setName('testName');
		$parameter->setTYpe('Test_Type');
		$parameter->setDescription('This is a description');
		$this->assertEquals($expected, $parameter->getDocumentation());
	}

	/**
	 * @depends testSyncronizedTypeHint
	 */
	function testUnsyncronizedTypeHint()
	{
		$parameter = $this->_getInstance();
		$parameter->setType('AnotherType');
		$parameter->setTypeHint('ABC_DEF');
		$this->assertNotEquals($parameter->getTypeHint(), $parameter->getType());
	}
}