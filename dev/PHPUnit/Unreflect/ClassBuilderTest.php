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
 * @see Unreflect_ClassBuilder
 */
class Test_Unreflect_ClassBuilderTest
	extends Test_Unreflect_TestCase
{
	/**
	 * @return Unreflect_ClassBuilder
	 */
	protected function _getInstance()
	{
		$return = new Unreflect_ClassBuilder();
		return $return;
	}

	/**
	 * Test to ensure the class exists and initilizes correctly
	 */
	function testInstance()
	{
		$this->assertClassExists('Unreflect_ClassBuilder');
		$instance = new Unreflect_ClassBuilder();
	}
	
	/**
	 * @depends testInstance
	 */
	function testAddInterface()
	{
		$class = $this->_getInstance();
		$this->assertSame($class, $class->addInterface('testInterface'));
	}

	/**
	 * @depends testInstance
	 */
	function testAddMethod()
	{
		$this->assertClassExists('Unreflect_MethodBuilder');
		$method = new Unreflect_MethodBuilder();
		$class = $this->_getInstance();
		$this->assertSame($class, $class->addMethod($method));
	}

	/**
	 * @depends testInstance
	 */
	function testAddProperty()
	{
		$this->assertClassExists('Unreflect_PropertyBuilder');
		$property = new Unreflect_PropertyBuilder();
		$class = $this->_getInstance();
		$this->assertSame($class, $class->addProperty($property));
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultDescription()
	{
		$class = $this->_getInstance();
		$this->assertEquals('', $class->getDescription());
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultDocumentation()
	{
		$expected = "\n/**\n */\n";
		$class = $this->_getInstance();
		$this->assertEquals($expected, $class->getDocumentation());
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultInterfaces()
	{
		$class = $this->_getInstance();
		$return = $class->getInterfaces();
		$this->assertTraversable($return);
		$this->assertEquals(0, count($return));
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultMethods()
	{
		$class = $this->_getInstance();
		$return = $class->getMethods();
		$this->assertTraversable($return);
		$this->assertEquals(0, count($return));
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultMethodDefinitions()
	{
		$class = $this->_getInstance();
		$this->assertEquals('', $class->getMethodDefinitions());
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultName()
	{
		$class = $this->_getInstance();
		$this->assertEquals('', $class->getName());
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultProperties()
	{
		$class = $this->_getInstance();
		$return = $class->getProperties();
		$this->assertTraversable($return);
		$this->assertEquals(0, count($return));
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultPropertyDefinitions()
	{
		$class = $this->_getInstance();
		$this->assertEquals('', $class->getPropertyDefinitions());
	}

	/**
	 * @depends testInstance
	 */
	function testGetDefaultParent()
	{
		$class = $this->_getInstance();
		$this->assertEquals('', $class->getParent());
	}


	/**
	 * @depends testInstance
	 */
	function testGetDefaultScope()
	{
		$class = $this->_getInstance();
		$this->assertEquals('', $class->getScope());
	}

	/**
	 * @depends testInstance
	 */
	function testIsAbstractDefault()
	{
		$class = $this->_getInstance();
		$this->assertFalse($class->isAbstract());
	}

	/**
	 * @depends testInstance
	 */
	function testIsFinalDefault()
	{
		$class = $this->_getInstance();
		$this->assertFalse($class->isFinal());
	}

	/**
	 * @depends testInstance
	 */
	function testSetAbstract()
	{
		$class = $this->_getInstance();
		$this->assertSame($class, $class->setAbstract());
	}

	/**
	 * @depends testInstance
	 */
	function testSetDescription($description)
	{
		$class = $this->_getInstance();
		$this->assertSame($class, $class->setDescription('testValue'));
	}

	/**
	 * @depends testInstance
	 */
	function testSetName($name)
	{
		$class = $this->_getInstance();
		$this->assertSame($class, $class->setName('testValue'));
	}

	/**
	 * @depends testInstance
	 */
	function testSetParent()
	{
		$class = $this->_getInstance();
		$this->assertSame($class, $class->setParent('testValue'));
	}

	/**
	 * @depends testInstance
	 */
	function testSetFinal()
	{
		$class = $this->_getInstance();
		$this->assertSame($class, $class->setFinal());
	}

	/**
	 * @depends testInstance
	 */
	function testSetScope()
	{
		$class = $this->_getInstance();
		$this->assertSame($class, $class->setScope());
	}

	/**
	 * @depends testAddInterface
	 */
	function testGetAddedInterfaces()
	{
		$class = $this->_getInstance();
		$class->addInterface('test');
		$return = $class->getInterfaces();
		$this->assertTraversable($return);
		$this->assertEquals(1, count($return));
		$this->assertEquals('test', reset($return));
	}

	/**
	 * @depends testAddInterface
	 */
	function testGetDefinitionInterface()
	{
		$expected = "class ParentClass\n\timplements TestInterface";
		$class = $this->_getInstance();
		$class->setName('ParentClass');
		$class->addInterface('TestInterface');
		$this->assertEquals($expected, $class->getDefinition());
	}

	/**
	 * @depends testAddInterface
	 */
	function testGetDefinitionInterfaces()
	{
		$expected = "class ParentClass\n\timplements TI2,\n\t\tTestInterface";
		$class = $this->_getInstance();
		$class->setName('ParentClass');
		$class->addInterface('TestInterface');
		$class->addInterface('TI2');
		$this->assertEquals($expected, $class->getDefinition());
	}

	/**
	 * @depends testAddMethod
	 */
	function testGetAddedMethod()
	{
		$method = new Unreflect_MethodBuilder();
		$method->setName('methodName');
		$class = $this->_getInstance();
		$class->addMethod($method);
		$return = $class->getMethods();
		$this->assertTraversable($return);
		$this->assertEquals(1, count($return));
		$this->assertSame($method, reset($return));
	}

	/**
	 * @depends testAddMethod
	 */
	function testGetAddedMethods()
	{
		$method1 = new Unreflect_MethodBuilder();
		$method2 = new Unreflect_MethodBuilder();
		$method1->setName('methodName1');
		$method2->setName('methodName2');
		$class = $this->_getInstance();
		$class->addMethod($method1)->addMethod($method2);
		$return = $class->getMethods();
		$this->assertTraversable($return);
		$this->assertEquals(2, count($return));
		$this->assertSame($method1, reset($return));
		$this->assertSame($method2, next($return));
	}

	/**
	 * @depends testAddMethod
	 */
	function testGetAddedMethodDefinition()
	{
		$method = new Unreflect_MethodBuilder();
		$method->setName('methodName');
		$class = $this->_getInstance();
		$class->addMethod($method);
		$this->assertEquals($method->export(), $class->getMethodDefinitions());
	}

	/**
	 * @depends testAddMethod
	 */
	function testGetAddedMethodDefinitions()
	{
		$method1 = new Unreflect_MethodBuilder();
		$method2 = new Unreflect_MethodBuilder();
		$method1->setName('methodName1');
		$method2->setName('methodName2');
		$expected = $method1->export() . $method2->export();
		$class = $this->_getInstance();
		$class->addMethod($method1)->addMethod($method2);
		$this->assertEquals($expected, $class->getMethodDefinitions());
	}

	/**
	 * @depends testAddMethod
	 */
	function testGetAddedProperty()
	{
		$property = new Unreflect_MethodBuilder();
		$property->setName('methodName');
		$class = $this->_getInstance();
		$class->addMethod($property);
		$return = $class->getMethods();
		$this->assertTraversable($return);
		$this->assertEquals(1, count($return));
		$this->assertSame($property, reset($return));
	}

	/**
	 * @depends testAddMethod
	 */
	function testGetAddedPropertyDefinition()
	{
		$property = new Unreflect_PropertyBuilder();
		$property->setName('propertyName');
		$class = $this->_getInstance();
		$class->addProperty($property);
		$this->assertEquals($property->export(), $class->getPropertyDefinitions());
	}

	/**
	 * @depends testAddMethod
	 */
	function testGetAddedPropertyDefinitions()
	{
		$property1 = new Unreflect_PropertyBuilder();
		$property2 = new Unreflect_PropertyBuilder();
		$property1->setName('propertyName1');
		$property2->setName('propertyName2');
		$expected = $property1->export() . $property2->export();
		$class = $this->_getInstance();
		$class->addProperty($property1)->addProperty($property2);
		$this->assertEquals($expected, $class->getPropertyDefinitions());
	}

	/**
	 * @depends testSetAbstract
	 */
	function testExportAbstract()
	{
		$expected = '
/**
 */
abstract class ParentClass
{
}
';
		$class = $this->_getInstance();
		$class->setName('ParentClass');
		$class->setAbstract();
		$this->assertEquals($expected, $class->export());
	}

	/**
	 * @depends testSetAbstract
	 */
	function testGetDefinitionAbstract()
	{
		$expected = 'abstract class ParentClass';
		$class = $this->_getInstance();
		$class->setName('ParentClass');
		$class->setAbstract();
		$this->assertEquals($expected, $class->getDefinition());
	}

	/**
	 * @depends testSetAbstract
	 */
	function testIsAbstractSet()
	{
		$class = $this->_getInstance();
		$class->setAbstract();
		$this->assertTrue($class->isAbstract());
	}

	/**
	 * @depends testSetDescription
	 */
	function testGetDocumentation()
	{
		$expected = '
/**
 * Test Description
 */
';
		$class = $this->_getInstance();
		$class->setDescription('Test Description');
		$this->assertEquals($expected, $class->getDocumentation());
	}

	/**
	 * @depends testSetDescription
	 */
	function testGetSetDescription()
	{
		$expected = 'Test Description';
		$class = $this->_getInstance();
		$class->setDescription($expected);
		$this->assertEquals($expected, $class->getDescription());
	}

	/**
	 * @depends testSetName
	 */
	function testExport()
	{
		$expected = '
/**
 */
class TestClass
{
}
';
		$class = $this->_getInstance();
		$class->setName('TestClass');
		$this->assertEquals($expected, $class->export());
	}

	/**
	 * @depends testSetName
	 */
	function testGetDefinition()
	{
		$expected = 'class ParentClass';
		$class = $this->_getInstance();
		$class->setName('ParentClass');
		$this->assertEquals($expected, $class->getDefinition());
	}

	/**
	 * @depends testSetName
	 */
	function testGetSetName()
	{
		$class = $this->_getInstance();
		$class->setName('testName');
		$this->assertEquals('testName', $class->getName());
	}

	/**
	 * @depends testSetFinal
	 */
	function testExportFinal()
	{
		$expected = '
/**
 */
final class ParentClass
{
}
';
		$class = $this->_getInstance();
		$class->setName('ParentClass');
		$class->setFinal();
		$this->assertEquals($expected, $class->export());
	}

	/**
	 * @depends testSetFinal
	 */
	function testGetDefinitionFinal()
	{
		$expected = 'final class ParentClass';
		$class = $this->_getInstance();
		$class->setName('ParentClass');
		$class->setFinal();
		$this->assertEquals($expected, $class->getDefinition());
	}

	/**
	 * @depends testSetFinal
	 */
	function testIsFinalSet()
	{
		$class = $this->_getInstance();
		$class->setFinal();
		$this->assertTrue($class->isFinal());
	}

	/**
	 * @depends testSetParent
	 */
	function testGetDefinitionParent()
	{
		$expected = "class ParentClass\n\textends ParentClass";
		$class = $this->_getInstance();
		$class->setName('ParentClass');
		$class->setParent('ParentClass');
		$this->assertEquals($expected, $class->getDefinition());
	}

	/**
	 * @depends testAddInterface
	 * @depends testSetParent
	 */
	function testGetDefinitionParentInterface()
	{
		$expected = 'class ParentClass
	extends ParentClass
	implements TestInterface';
		$class = $this->_getInstance();
		$class->setName('ParentClass');
		$class->setParent('ParentClass');
		$class->addInterface('TestInterface');
		$this->assertEquals($expected, $class->getDefinition());
	}

	/**
	 * @depends testAddInterface
	 * @depends testSetParent
	 */
	function testGetDefinitionParentInterfaces()
	{
		$expected = 'class ParentClass
	extends ParentClass
	implements TestInterface,
		TestInterface2';
		$class = $this->_getInstance();
		$class->setName('ParentClass');
		$class->setParent('ParentClass');
		$class->addInterface('TestInterface');
		$class->addInterface('TestInterface2');
		$this->assertEquals($expected, $class->getDefinition());
	}
}