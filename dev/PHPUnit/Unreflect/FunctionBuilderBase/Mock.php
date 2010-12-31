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
 * @package Unreflect
 */
require_once 'Unreflect/FunctionBuilderBase.php';

/**
 * Base class for all of the builders.
 */
class Test_Unreflect_FunctionBuilderBase_Mock
		extends Unreflect_FunctionBuilderBase
{
	function export()
	{
		return '';
	}
}