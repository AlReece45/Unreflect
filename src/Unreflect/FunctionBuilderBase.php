<?php
/*
 * Enject Library
 * Copyright 2010 Alexander Reece
 * Licensed under: GNU Lesser Public License 2.1 or later
 */
/**
 * @author Alexander Reece <AlReece45@gmail.com>
 * @copyright 2010 (c) Alexander Reece
 * @license http://www.opensource.org/licenses/lgpl-2.1.php
 * @package Unreflect
 */
require_once 'Unreflect/Builder.php';

/**
 * Base class for all of the builders.
 */
abstract class Unreflect_FunctionBuilderBase
	implements Unreflect_Builder
{
	/**
	 * @var String
	 */
	protected $_body = '';

	/**
	 * @var String
	 */
	protected $_description = '';

	/**
	 * @var String
	 */
	protected $_name = '';

	/**
	 * @var Unreflect_ParameterBuilder[]
	 */
	protected $_parameters = array();

	/**
	 * @var String
	 */
	protected $_type;

	/**
	 * @param Unreflect_ParameterBuilderBase $parameter
	 * @return Unreflect_FunctionBuilderBase
	 */
	function addParameter($parameter)
	{
		$this->_parameters[] = $parameter;
		return $this;
	}

	/**
	 * @return String
	 */
	function getBody()
	{
		return $this->_body;
	}

	/**
	 * @return String
	 */
	function getDescription()
	{
		return $this->_description;
	}

	/**
	 * @return String
	 */
	function getName()
	{
		return $this->_name;
	}

	/**
	 * Gets the definition used when defining a method.
	 * @return String
	 */
	function getDefinition()
	{
		$parameterString = '';
		$parameters = $this->getParameters();
		if($parameters)
		{
			foreach($this->getParameters() as $parameter)
			{
				$parameterString .= $parameter->export() . ', ';
			}
			$parameterString = substr($parameterString, 0, -2);
		}
		return "function {$this->getName()}($parameterString)";
	}

	/**
	 * Gets the docblock to use defining a parameter.
	 * @return String
	 */
	function getDocumentation()
	{
		$description = $this->getDescription();
		$return = $description ? "\n$description" : '';
		$type = $this->getType();
		foreach($this->getParameters() as $parameter)
		{
			$return .= "\n" . $parameter->getDocumentation();
		}
		if($type)
		{
			$return .= "\n@return $type";
		}
		return "\n"
			. "/**" . str_replace("\n", "\n * ", $return) . "\n */\n";
	}

	/**
	 * Gets a property, adds it to the end of the list if it doesn't exist
	 * @param String $name
	 * @return Unreflect_ParameterBuilder
	 */
	function getParameter($name)
	{
		require_once 'Unreflect/ParameterBuilder.php';
		$parameter = new Unreflect_ParameterBuilder();
		$parameter->setName($name);
		return $parameter;
	}

	/**
	 * @return Unreflect_ParameterBuilder[]
	 */
	function getParameters()
	{
		return $this->_parameters;
	}

	/**
	 * @return String
	 */
	function getType()
	{
		return $this->_type;
	}

	/**
	 * @param String $body
	 * @return Unreflect_FunctionBuilderBase
	 */
	function setBody($body)
	{
		$this->_body = $body;
		return $this;
	}

	/**
	 * @param String $body
	 * @return Unreflect_FunctionBuilderBase
	 */
	function setDescription($description)
	{
		$this->_description = $description;
		return $this;
	}

	/**
	 * @param String $name
	 * @return Unreflect_FunctionBuilderBase
	 */
	function setName($name)
	{
		$this->_name = $name;
		return $this;
	}

	/**
	 * @param String $type
	 * @return Unreflect_FunctionBuilderBase
	 */
	function setType($type)
	{
		$this->_type = $type;
		return $this;
	}
}