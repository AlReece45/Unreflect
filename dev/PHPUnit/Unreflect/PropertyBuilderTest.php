<?php
/*
 * Unreflect Library Tests
 * Copyright 2010-2011 Alexander Reece
 * Licensed under: GNU Lesser Public License 2.1 or later
 */
/**
 * @author Alexander Reece <AlReece45@gmail.com>
 * @copyright 2010-2011 (c) Alexander Reece
 * @license http://www.opensource.org/licenses/lgpl-2.1.php
 * @package Test_Unreflect
 */
require_once 'Unreflect/TestCase.php';

/**
 * @see Unreflect_MethodBuilder
 */
class Test_Unreflect_PropertyBuilderTest
	extends Test_Unreflect_TestCase
{
	/**
	 * @return Unreflect_MethodBuilder
	 */
	function _getInstance()
	{
		$return = new Unreflect_PropertyBuilder();
		return $return;
	}

	/**
	 * Ennsures the class exists and initializes correctly
	 */
	function testInstance()
	{
		$this->assertClassExists('Unreflect_PropertyBuilder');
		$instance = new Unreflect_PropertyBuilder();
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
	function testGetDefaultScope()
	{
		$method = $this->_getInstance();
		$this->assertEquals('', $method->getScope());
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
	function testGetDefaultVisibility()
	{
		$method = $this->_getInstance();
		$this->assertEquals('', $method->getVisibility());
	}

	/**
	 * @depends testInstance
	 */
	function testGetDocumentationDefault()
	{
		$expected = '
/**
 * @var Mixed
 */
';
		$function = $this->_getInstance();
		$this->assertEquals($expected, $function->getDocumentation());
	}

	/**
	 * @depends testInstance
	 */
	function testIsPrivateDefault()
	{
		$method = $this->_getInstance();
		$this->assertFalse($method->isPrivate());
	}

	/**
	 * @depends testInstance
	 */
	function testIsProtectedDefault()
	{
		$method = $this->_getInstance();
		$this->assertFalse($method->isProtected());
	}

	/**
	 * @depends testInstance
	 */
	function testIsPublicDefault()
	{
		$method = $this->_getInstance();
		$this->assertTrue($method->isPublic());
	}

	/**
	 * @depends testInstance
	 */
	function testIsStaticDefault()
	{
		$method = $this->_getInstance();
		$this->assertFalse($method->isStatic());
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
	function testSetPrivate()
	{
		$method = $this->_getInstance();
		$this->assertSame($method, $method->setPrivate());
	}

	/**
	 * @depends testInstance
	 */
	function testSetProtected()
	{
		$method = $this->_getInstance();
		$this->assertSame($method, $method->setProtected());
	}

	/**
	 * @depends testInstance
	 */
	function testSetPublic()
	{
		$method = $this->_getInstance();
		$this->assertSame($method, $method->setPublic());
	}

	/**
	 * @depends testInstance
	 */
	function testSetScope()
	{
		$method = $this->_getInstance();
		$this->assertSame($method, $method->setScope());
	}

	/**
	 * @depends testInstance
	 */
	function testSetStatic()
	{
		$method = $this->_getInstance();
		$this->assertSame($method, $method->setStatic());
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
	function testSetVisibility()
	{
		$method = $this->_getInstance();
		$this->assertSame($method, $method->setVisibility('public'));
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
		$expected = '
/**
 * @var Mixed
 */
public $testProperty;
';
		$method = $this->_getInstance();
		$method->setName('testProperty');
		$this->assertEquals($expected, $method->export());
	}

	/**
	 * @depends testSetName
	 */
	function testGetDefinition()
	{
		$expected = 'public $testProperty;';
		$method = $this->_getInstance();
		$method->setName('testProperty');
		$this->assertEquals($expected, $method->getDefinition());
	}
	
	/**
	 * @depends testSetPrivate
	 */
	function testIsPrivateSet()
	{
		$method = $this->_getInstance();
		$method->setPrivate();
		$this->assertTrue($method->isPrivate());
	}

	/**
	 * @depends testSetProtected
	 */
	function testIsProtectedSet()
	{
		$method = $this->_getInstance();
		$method->setProtected();
		$this->assertTrue($method->isProtected());
	}

	/**
	 * @depends testSetProtected
	 */
	function testIsProtectedNotPrivate()
	{
		$method = $this->_getInstance();
		$method->setProtected();
		$this->assertFalse($method->isPrivate());
	}

	/**
	 * @depends testSetProtected
	 */
	function testIsProtectedNotPublic()
	{
		$method = $this->_getInstance();
		$method->setProtected();
		$this->assertFalse($method->isPublic());
	}

	/**
	 * @depends testSetPublic
	 */
	function testIsPublicSet()
	{
		$method = $this->_getInstance();
		$method->setPublic();
		$this->assertTrue($method->isPublic());
	}

	/**
	 * @depends testSetPublic
	 */
	function testIsPublicNotPrivate()
	{
		$method = $this->_getInstance();
		$method->setPublic();
		$this->assertFalse($method->isPrivate());
	}

	/**
	 * @depends testSetPublic
	 */
	function testIsPublicNotProtected()
	{
		$method = $this->_getInstance();
		$method->setPublic();
		$this->assertFalse($method->isProtected());
	}

	/**
	 * @depends testSetScope
	 */
	function testGetSetScope()
	{
		$expected = 'abstract';
		$method = $this->_getInstance();
		$method->setScope($expected);
		$this->assertEquals($expected, $method->getScope());
	}

	/**
	 * @depends testSetScope
	 */
	function testSetScopeStatic()
	{
		$expected = 'static';
		$method = $this->_getInstance();
		$method->setScope($expected);
		$this->assertTrue($method->isStatic());
	}

	/**
	 * @depends testSetStatic
	 */
	function testGetDefinitionStatic()
	{
		$expected = 'static $testProperty;';
		$method = $this->_getInstance();
		$method->setName('testProperty');
		$method->setStatic();
		$this->assertEquals($expected, $method->getDefinition());
	}

	/**
	 * @depends testSetVisibility
	 */
	function testGetSetVisibility()
	{
		$expected = 'public';
		$method = $this->_getInstance();
		$method->setVisibility($expected);
		$this->assertEquals($expected, $method->getVisibility());
	}

	/**
	 * @depends testSetVisibility
	 */
	function testSetVisibilityPrivate()
	{
		$method = $this->_getInstance();
		$method->setVisibility('private');
		$this->assertTrue($method->isPrivate());
	}

	/**
	 * @depends testSetVisibility
	 */
	function testSetVisibilityProtected()
	{
		$method = $this->_getInstance();
		$method->setVisibility('protected');
		$this->assertTrue($method->isProtected());
	}

	/**
	 * @depends testSetVisibility
	 */
	function testSetVisibilityPublic()
	{
		$method = $this->_getInstance();
		$method->setVisibility('public');
		$this->assertTrue($method->isPublic());
	}

	/**
	 * @depends testSetName
	 * @depends testSetDefault
	 */
	function testGetDefinitionWithDefault()
	{
		$expected = 'public $testProperty = \'testValue\';';
		$method = $this->_getInstance();
		$method->setName('testProperty');
		$method->setDefault('testValue');
		$this->assertEquals($expected, $method->getDefinition());
	}

	/**
	 * @depends testSetName
	 * @depends testSetDefault
	 */
	function testGetDefinitionWithDefaultValue()
	{
		$expected = 'public $testProperty = CONSTANT;';
		$method = $this->_getInstance();
		$method->setName('testProperty');
		$method->setDefault('CONSTANT', false);
		$this->assertEquals($expected, $method->getDefinition());
	}

	/**
	 * @depends testSetName
	 * @depends testSetPrivate
	 */
	function testGetDefinitionPrivate()
	{
		$expected = 'private $_testProperty;';
		$method = $this->_getInstance();
		$method->setName('_testProperty');
		$method->setPrivate();
		$this->assertEquals($expected, $method->getDefinition());
	}

	/**
	 * @depends testSetName
	 * @depends testSetProtected
	 */
	function testGetDefinitionProtected()
	{
		$expected = 'protected $_testProperty;';
		$method = $this->_getInstance();
		$method->setName('_testProperty');
		$method->setProtected();
		$this->assertEquals($expected, $method->getDefinition());
	}

	/**
	 * @depends testSetName
	 * @depends testSetPublic
	 */
	function testGetDefinitionPublic()
	{
		$expected = 'public $testProperty;';
		$method = $this->_getInstance();
		$method->setName('testProperty');
		$method->setPublic();
		$this->assertEquals($expected, $method->getDefinition());
	}

	/**
	 * @depends testSetProtected
	 * @depends testSetPrivate
	 */
	function testIsPrivateNotProtected()
	{
		$method = $this->_getInstance();
		$method->setProtected();
		$method->setPrivate();
		$this->assertFalse($method->isProtected());
	}

	/**
	 * @depends testSetPublic
	 * @depends testSetPrivate
	 */
	function testIsPrivateNotPublic()
	{
		$method = $this->_getInstance();
		$method->setPublic();
		$method->setPrivate();
		$this->assertFalse($method->isPublic());
	}

	/**
	 * @depends testSetStatic
	 * @depends testSetScope
	 */
	function testSetScopeNotStatic()
	{
		$method = $this->_getInstance();
		$method->setStatic();
		$method->setScope();
		$this->assertFalse($method->isStatic());
	}
}