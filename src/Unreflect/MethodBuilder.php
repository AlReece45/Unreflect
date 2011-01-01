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
require_once 'Unreflect/FunctionBuilderBase.php';

/**
 * Class to build methods in classes
 */
class Unreflect_MethodBuilder
	extends Unreflect_FunctionBuilderBase
{
	/**
	 * @var String
	 */
	protected $_visibility = '';

	/**
	 * @var Mixed
	 */
	protected $_scope = '';

	/**
	 * @return String
	 */
	function getDefinition()
	{
		$scope = $this->getScope();
		$visibility = $this->getVisibility();
		return ($visibility ? "$visibility " : '')
			. ($scope ? "$scope " : '')
			. parent::getDefinition();
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
	function getVisibility()
	{
		return $this->_visibility;
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
	function isPrivate()
	{
		return $this->getVisibility() == 'private';
	}

	/**
	 * @return Boolean
	 */
	function isProtected()
	{
		return $this->getVisibility() == 'protected';
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
		return $this->getScope() == 'static';
	}

	/**
	 * @return Unreflect_MethodBuilder
	 */
	function setAbstract()
	{
		return $this->setScope('abstract');
	}

	/**
	 * @return Unreflect_MethodBuilder
	 */
	function setPrivate()
	{
		return $this->setVisibility('private');
	}

	/**
	 * @return Unreflect_MethodBuilder
	 */
	function setProtected()
	{
		return $this->setVisibility('protected');
	}

	/**
	 * @return Unreflect_MethodBuilder
	 */
	function setPublic()
	{
		return $this->setVisibility('public');
	}

	/**
	 * @param String $scope
	 * @return Unreflect_MethodBuilder
	 */
	function setScope($scope = '')
	{
		$this->_scope = $scope;
		return $this;
	}

	/**
	 * @return Unreflect_MethodBuilder
	 */
	function setStatic()
	{
		return $this->setScope('static');
	}

	/**
	 * @param String $visibility
	 * @return Unreflect_MethodBuilder
	 */
	function setVisibility($visibility  = '')
	{
		$this->_visibility = $visibility;
		return $this;
	}

	/**
	 * Exports the function into executable code.
	 * @return String
	 */
	function export()
	{
		$return = $this->getDocumentation() . $this->getDefinition();
		if($this->isAbstract())
		{
			$return .= ";\n";
		}
		else
		{
			$return .= "\n{"
				. str_replace("\n", "\n\t", "\n" . $this->getBody())
				. "\n}\n";
		}
		return $return;
	}
}