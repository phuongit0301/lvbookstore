<?php
namespace App\Repositories;

use App\Http\Models\Category;
use App\Repositories\Interfaces\CategoryInterface;

class CategoryRepository implements CategoryInterface 
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this->category, $method], $args);
    }

    public function all()
    {
    	return $this->category->all();
    }

    // @param $key string
    public function get()
    {
        return $this->category->get();
    }

    /**
     * create a token
     * @param $openid
     * @return string
     *
     */
    public function create(array $data)
    {
        try {
            return $this->category->create($data);
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function sort($column = null)
    {
        try {
            return $this->category->orderBy($column)->get();
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function findOrFail($id = null)
    {
        if(isset($id) && (int) $id > 0) {
            try {
                return $this->category->findOrFail($id);
            } catch (Exception $e) {
                echo $e->getMessage();
                die();
            }
        }
    }

    public function update(array $data, $id)
    {
        if(!empty($data) && isset($id) && (int) $id > 0) {
            try {
                return $this->category->findOrFail($id)->update($data);
            } catch (Exception $e) {
                echo $e->getMessage();
                die();
            }
        }
    }

    public function delete($id = null)
    {
        if(!empty($id) && (int) $id > 0) {
            try {
                return $this->category->findOrFail($id)->delete();
            } catch (Exception $e) {
                echo $e->getMessage();
                die();
            }
        }
    }

}