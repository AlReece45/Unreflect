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
require_once 'Unreflect/FunctionBuilderBase.php';

/**
 * Base class for all of the builders.
 */
class Unreflect_FunctionBuilder
	extends Unreflect_FunctionBuilderBase
{
	/**
	 * @return String
	 */
	function export()
	{
		return $this->getDocumentation() . $this->getDefinition() . "\n{"
			. str_replace("\n", "\n\t", "\n" . $this->getBody()) . "\n}\n";
	}
}
