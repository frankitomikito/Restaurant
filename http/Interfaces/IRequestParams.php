<?php 

interface IRequestParams {
	public static function PARAMGET($param_name);
	public static function PARAMPOST($param_name = false);
	public static function PARAMFILE($param_name);
}