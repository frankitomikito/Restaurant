<?php 

interface IRequestMethod {
	public static function GET($callback);
	public static function POST($callback);
	public static function PUT($callback);
	public static function DELETE($callback);
}