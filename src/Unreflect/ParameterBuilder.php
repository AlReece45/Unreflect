<?php
/*
 * Unreflect Library
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
class Unreflect_ParameterBuilder
	implements Unreflect_Builder
{
	/**
	 * @var String
	 */
	protected $_default;

	/**
	 * @var String
	 */
	protected $_description = '';

	/**
	 * @var String
	 */
	protected $_name;

	/**
	 * @var String
	 */
	protected $_type = 'Mixed';

	/**
	 * @var String
	 */
	protected $_typeHint;

	/**
	 * Exports the function into executable code.
	 * @return String
	 */
	function export()
	{
		$typeHint = $this->getTypeHint();
		$default = $this->getDefault();
		return ($typeHint ? "$typeHint " : '')
			. "\${$this->getName()}"
			. ($default ? " = $default" : '');
	}

	/**
	 * @return String
	 */
	function getDefault()
	{
		return $this->_default;
	}

	/**
	 * @return String
	 */
	function getDescription()
	{
		return $this->_description;
	}

	/**
	 * Exports the documentation
	 * @return String
	 */
	function getDocumentation()
	{
		$description = $this->getDescription();
		$type = $this->getType();
		if($description)
		{
			$description = " $description";
		}
		if(!$type)
		{
			$type = $this->getTypeHint();
			if(!$type)
			{
				$type = 'Mixed';
			}
		}
		return "@param $type \${$this->getName()}$description";
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
	function getType()
	{
		return $this->_type;
	}

	/**
	 * @return String
	 */
	function getTypeHint()
	{
		return $this->_typeHint;
	}

	/**
	 * @param String $default
	 * @param Boolean $value
	 * @return Unreflect_ParameterBuilder
	 */
	function setDefault($default, $value = true)
	{
		if($value)
		{
			$default = var_export($default, true);
		}
		$this->_default = $default;
		return $this;
	}

	/**
	 * @param String $description
	 * @return Unreflect_ParameterBuilder
	 */
	function setDescription($description)
	{
		$this->_description = $description;
		return $this;
	}

	/**
	 * @param String $name
	 * @return Unreflect_ParameterBuilder
	 */
	function setName($name)
	{
		$this->_name = $name;
		return $this;
	}

	/**
	 * @param String $type
	 * @return Unreflect_ParameterBuilder
	 */
	function setType($type)
	{
		$this->_type = $type;
		return $this;
	}
	
	/**
	 * @param String $typeHint
	 * @return Unreflect_ParameterBuilder
	 */
	function setTypeHint($typeHint)
	{
		if($this->_type == $this->_typeHint || $this->_type == 'Mixed')
		{
			$this->_type = $typeHint;
		}
		$this->_typeHint = $typeHint;
		return $this;
	}
}