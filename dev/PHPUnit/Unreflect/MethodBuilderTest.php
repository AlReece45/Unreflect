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
class Test_Unreflect_MethodBuilderTest
	extends Test_Unreflect_TestCase
{
	/**
	 * @return Unreflect_MethodBuilder
	 */
	function _getInstance()
	{
		$return = new Unreflect_MethodBuilder();
		return $return;
	}

	/**
	 * Ennsures the class exists and initializes correctly
	 */
	function testInstance()
	{
		$this->assertClassExists('Unreflect_MethodBuilder');
		$instance = new Unreflect_MethodBuilder();
	}

	/**
	 * @depends testInstance
	 */
	function testExport()
	{
		$expected = '
/**
 * @return Mixed
 */
function testMethod()
{
	
}
';
		$method = $this->_getInstance();
		$method->setName('testMethod');
		$method->setType('Mixed');
		$this->assertEquals($expected, $method->export());
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefinition()
	{
		$expected = 'function testMethod()';
		$method = $this->_getInstance()->setName('testMethod');
		$this->assertEquals($expected, $method->getDefinition());
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
	function testGetDefaultVisibility()
	{
		$method = $this->_getInstance();
		$this->assertEquals('', $method->getVisibility());
	}

	/**
	 * @depends testInstance
	 */
	function testIsAbstractDefault()
	{
		$method = $this->_getInstance();
		$this->assertFalse($method->isAbstract());
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
	function testSetAbstract()
	{
		$method = $this->_getInstance();
		$this->assertSame($method, $method->setAbstract());
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
	function testSetVisibility()
	{
		$method = $this->_getInstance();
		$this->assertSame($method, $method->setVisibility('public'));
	}

	/**
	 * @depends testSetAbstract
	 */
	function testExportAbstract()
	{
		$expected = '
/**
 * @return Mixed
 */
abstract function testMethod();
';
		$method = $this->_getInstance();
		$method->setName('testMethod');
		$method->setType('Mixed');
		$method->setAbstract();
		$this->assertEquals($expected, $method->export());
	}

	/**
	 * @depends testSetAbstract
	 */
	function testGetDefinitionAbstract()
	{
		$expected = 'abstract function testMethod()';
		$method = $this->_getInstance();
		$method->setName('testMethod');
		$method->setAbstract();
		$this->assertEquals($expected, $method->getDefinition());
	}

	/**
	 * @depends testSetAbstract
	 */
	function testIsAbstractSet()
	{
		$method = $this->_getInstance();
		$method->setAbstract();
		$this->assertTrue($method->isAbstract());
	}

	/**
	 * @depends testSetPrivate
	 */
	function testGetDefinitionPrivate()
	{
		$expected = 'private function _testMethod()';
		$method = $this->_getInstance();
		$method->setName('_testMethod');
		$method->setPrivate();
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
	function testGetDefinitionProtected()
	{
		$expected = 'protected function _testMethod()';
		$method = $this->_getInstance();
		$method->setName('_testMethod');
		$method->setProtected();
		$this->assertEquals($expected, $method->getDefinition());
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
	function testGetDefinitionPublic()
	{
		$expected = 'public function testMethod()';
		$method = $this->_getInstance();
		$method->setName('testMethod');
		$method->setPublic();
		$this->assertEquals($expected, $method->getDefinition());
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
	function testSetScopeAbstract()
	{
		$expected = 'abstract';
		$method = $this->_getInstance();
		$method->setScope($expected);
		$this->assertTrue($method->isAbstract());
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
		$expected = 'static function testMethod()';
		$method = $this->_getInstance();
		$method->setName('testMethod');
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
	 * @depends testSetAbstract
	 * @depends testSetScope
	 */
	function testSetScopeNotAbstract()
	{
		$method = $this->_getInstance();
		$method->setAbstract();
		$method->setScope();
		$this->assertFalse($method->isAbstract());
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

	/**
	 * @depends testSetAbstract
	 * @depends testSetStatic
	 */
	function testIsAbstractNotStatic()
	{
		$method = $this->_getInstance();
		$method->setStatic();
		$method->setAbstract();
		$this->assertFalse($method->isStatic());
	}

	/**
	 * @depends testSetAbstract
	 * @depends testSetStatic
	 */
	function testIsStaticNotAbstract()
	{
		$method = $this->_getInstance();
		$method->setAbstract();
		$method->setStatic();
		$this->assertFalse($method->isAbstract());
	}
}