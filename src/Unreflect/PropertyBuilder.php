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
 * Class to build properties in classes
 */
class Unreflect_PropertyBuilder
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
	 * @var Mixed
	 */
	protected $_scope = '';

	/**
	 * @var String
	 */
	protected $_type = 'Mixed';

	/**
	 * @var String
	 */
	protected $_visibility = '';

	/**
	 * @return String
	 */
	function export()
	{
		return $this->getDocumentation() . $this->getDefinition() . "\n";
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
	function getDefinition()
	{
		$default = $this->getDefault();
		$scope = $this->getScope();
		$visibility = $this->getVisibility();
		if((!$visibility) && (!$this->isStatic()))
		{
			$visibility = 'public';
		}
		return ($visibility ? "$visibility " : '')
			. ($scope ? "$scope " : '')
			. '$' . $this->getName()
			. ($default ? ' = ' . $default : '') . ";";
	}

	/**
	 * @return String
	 */
	function getDescription()
	{
		return $this->_description;
	}

	/**
	 * Gets the docblock to use defining a property.
	 * @return String
	 */
	function getDocumentation()
	{
		$description = $this->getDescription();
		$return = $description ? "\n$description" : '';
		$type = $this->getType();
		if($type)
		{
			$return .= "\n@var $type";
		}
		return "\n"
			. "/**" . str_replace("\n", "\n * ", $return) . "\n */\n";
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
	function getScope()
	{
		return $this->_scope;
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
	function getVisibility()
	{
		return $this->_visibility;
	}

	/**
	 * @return Boolean
	 */
	function isPrivate()
	{
		return stripos($this->getVisibility(), 'private') === 0;
	}

	/**
	 * @return Boolean
	 */
	function isProtected()
	{
		return strcmp($this->getVisibility(), 'protected') === 0;
	}

	/**
	 * @return Boolean
	 */
	function isPublic()
	{
		return !($this->isProtected() || $this->isPrivate());
	}

	/**
	 * @return Boolean
	 */
	function isStatic()
	{
		return strcmp($this->getScope(), 'static') === 0;
	}

	/**
	 * @param String $default
	 * @param Boolean $value
	 * @return Unreflect_PropertyBuilder
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
	 * @return Unreflect_PropertyBuilder
	 */
	function setDescription($description)
	{
		$this->_description = $description;
		return $this;
	}

	/**
	 * @param String $name
	 * @return Unreflect_PropertyBuilder
	 */
	function setName($name)
	{
		$this->_name = $name;
		return $this;
	}

	/**
	 * @param String $type
	 * @return Unreflect_PropertyBuilder
	 */
	function setType($type)
	{
		$this->_type = $type;
		return $this;
	}

	/**
	 * @return Unreflect_PropertyBuilder
	 */
	function setPrivate()
	{
		return $this->setVisibility('private');
	}

	/**
	 * @return Unreflect_PropertyBuilder
	 */
	function setProtected()
	{
		return $this->setVisibility('protected');
	}

	/**
	 * @return Unreflect_PropertyBuilder
	 */
	function setPublic()
	{
		return $this->setVisibility('public');
	}

	/**
	 * @param String $visibility
	 * @return Unreflect_PropertyBuilder
	 */
	function setScope($scope = '')
	{
		$this->_scope = $scope;
		return $this;
	}

	/**
	 * @return Unreflect_PropertyBuilder
	 */
	function setStatic()
	{
		return $this->setScope('static');
	}

	/**
	 * @param String $visibility
	 * @return Unreflect_PropertyBuilder
	 */
	function setVisibility($visibility  = '')
	{
		$this->_visibility = $visibility;
		return $this;
	}
}