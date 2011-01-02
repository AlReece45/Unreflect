<?php
/*
 * Unreflect Library
 * Copyright 2010-2011 Alexander Reece
 * Licensed under: GNU Lesser Public License 2.1 or later
 */
/**
 * @author Alexander Reece <AlReece45@gmail.com>
 * @copyright 2010-2011 (c) Alexander Reece
 * @license http://www.opensource.org/licenses/lgpl-2.1.php
 * @package Unreflect
 */
require_once 'Unreflect/Builder.php';

/**
 * Class for building other classes.
 */
class Unreflect_ClassBuilder
	implements Unreflect_Builder
{
	/**
	 * @var String
	 */
	protected $_description = '';

	/**
	 * @var String[]
	 */
	protected $_interfaces = array();

	/**
	 * @var splStorage
	 */
	protected $_methods;

	/**
	 * @var String
	 */
	protected $_name = '';

	/**
	 * @var String
	 */
	protected $_parent;

	/**
	 * @var splStorage
	 */
	protected $_properties;

	/**
	 * @var String
	 */
	protected $_scope = '';

	/**
	 * @param String $interface
	 * @return Unreflect_ClassBuilder
	 */
	function addInterface($interface)
	{
		$this->_interfaces[$interface] = $interface;
		return $this;
	}

	/**
	 * @param Unreflect_FunctionBuilder $function
	 * @return Unreflect_ClassBuilder
	 */
	function addMethod(Unreflect_MethodBuilder $function)
	{
		if(!$this->_methods instanceOf SplObjectStorage)
		{
			$this->_methods = new SplObjectStorage();
		}
		$this->_methods->attach($function);
		return $this;
	}

	/**
	 * @param Unreflect_PropertyBuilder $property
	 */
	function addProperty(Unreflect_PropertyBuilder $property)
	{
		if(!$this->_properties instanceOf SplObjectStorage)
		{
			$this->_properties = new SplObjectStorage();
		}
		$this->_properties->attach($property);
		return $this;
	}

	/**
	 * @return String
	 */
	function getDefinition()
	{
		$interfaces = $this->getInterfaces();
		ksort($interfaces);
		$interfaceString = implode(",\n\t\t", $interfaces);
		$parent = $this->getParent();
		$scope = $this->getScope();
		return ($scope ? "$scope " : '')
			. 'class ' . $this->getName()
			. ($parent ? "\n\textends $parent" : '')
			. ($interfaces ? "\n\timplements " . $interfaceString : '');
	}

	/**
	 * @return String
	 */
	function getDescription()
	{
		return $this->_description;
	}

	/**
	 * Gets the docblock to use defining a parameter.
	 * @return String
	 */
	function getDocumentation()
	{
		$description = $this->getDescription();
		$return = $description ? "\n$description" : '';
		return "\n/**" . str_replace("\n", "\n * ", $return) . "\n */\n";
	}

	/**
	 * @return String[]
	 */
	function getInterfaces()
	{
		return $this->_interfaces;
	}

	/**
	 * @return Unreflect_MethodBuilder[]
	 */
	function getMethods()
	{
		$return = array();
		if($this->_methods instanceOf SplObjectStorage)
		{
			$methodMap = array();
			foreach($this->_methods as $method)
			{
				$name = $method->getName();
				$lowerName = strtolower($name);
				if((!isset($methodMap[$lowerName]))
					 && ($method instanceOf Unreflect_MethodBuilder))
				{
					$return[$name] = $method;
					$methodMap[$lowerName] = true;
				}
			}
		}
		return $return;
	}

	/**
	 * @return String
	 */
	function getMethodDefinitions()
	{
		$return = '';
		$methods = $this->getMethods();
		ksort($methods);
		foreach($methods as $method)
		{
			$return .= $method->export();
		}
		return $return;
	}

	/**
	 * @return String
	 */
	function getName()
	{
		return $this->_name;
	}

	/**
	 * @return String
	 */
	function getParent()
	{
		return $this->_parent;
	}

	/**
	 * @return Unreflect_PropertyBuilder[]
	 */
	function getProperties()
	{
		$return = array();
		if($this->_properties instanceOf SplObjectStorage)
		{
			$propertyMap = array();
			foreach($this->_properties as $property)
			{
				$name = $property->getName();
				$lowerName = strtolower($name);
				if((!isset($propertyMap[$lowerName]))
					 && ($property instanceOf Unreflect_PropertyBuilder))
				{
					$return[$name] = $property;
					$propertyMap[$lowerName] = true;
				}
			}
		}
		return $return;
	}

	/**
	 * @return String
	 */
	function getPropertyDefinitions()
	{
		$return = '';
		$properties = $this->getProperties();
		ksort($properties);
		foreach($properties as $property)
		{
			$return .= $property->export();
		}
		return $return;
	}

	/**
	 * @return String
	 */
	function getScope()
	{
		return $this->_scope;
	}

	/**
	 * @return Boolean
	 */
	function isAbstract()
	{
		return $this->getScope() == 'abstract';
	}

	/**
	 * @return Boolean
	 */
	function isFinal()
	{
		return $this->getScope() == 'final';
	}

	/**
	 * @return Unreflect_ClassBuilder
	 */
	function setAbstract()
	{
		$this->setScope('abstract');
		return $this;
	}

	/**
	 * @param String $description
	 * @return Unreflect_ClassBuilder
	 */
	function setDescription($description)
	{
		$this->_description = $description;
		return $this;
	}

	/**
	 * @param String $name
	 * @return Unreflect_ClassBuilder
	 */
	function setName($name)
	{
		$this->_name = $name;
		return $this;
	}

	/**
	 * @return Unreflect_ClassBuilder
	 */
	function setFinal()
	{
		$this->setScope('final');
		return $this;
	}

	/**
	 * @param String $parent
	 * @return Unreflect_ClassBuilder
	 */
	function setParent($parent = '')
	{
		$this->_parent = $parent;
		return $this;
	}

	/**
	 * @param String $scope
	 * @return Unreflect_ClassBuilder
	 */
	function setScope($scope = '')
	{
		$this->_scope = $scope;
		return $this;
	}

	/**
	 * @return String
	 */
	function export()
	{
		$methodDefinitions = $this->getMethodDefinitions();
		$propertyDefinitions = $this->getPropertyDefinitions();
		return $this->getDocumentation() . $this->getDefinition()
			 . "\n{"
			 . ($propertyDefinitions ? "\n" . $propertyDefinitions() : '')
			 . ($methodDefinitions ? "\n" . $methodDefinitions : '')
			 . "\n}\n";
	}
}