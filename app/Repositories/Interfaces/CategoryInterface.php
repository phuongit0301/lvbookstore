<?php

namespace App\Repositories\Interfaces;

interface CategoryInterface 
{
	public function all();
	//public function lists($value, $key = null);
	//public function lists($key = null);
	public function get();
	//public function paginate($perPage = 1, $columns = array('*'));
	public function create(array $data);

	public function findOrFail($id);

	public function update(array $data, $id);

	public function delete($id = null);
	//public function orderBy($column = null);
	// if you use mongodb then you'll need to specify primary key $attribute
	/*public function update(array $data, $id, $attribute = "id");
	public function delete($id);
	public function find($id, $columns = array('*'));
	public function findBy($field, $value, $columns = array('*'));
	public function findAllBy($field, $value, $columns = array('*'));
	public function findWhere($where, $columns = array('*'));*/
}