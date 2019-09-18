<?php 

interface IActions {
	public function get($id);
	public function getAll();
	public function create($args);
	public function update($args);
	public function remove($id);
	public function search($args);
}