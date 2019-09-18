<?php 

interface IDatabaseAction {
	public function rawQuery($query);
}