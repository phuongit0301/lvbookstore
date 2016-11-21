<?php
namespace App\Repositories;

use App\Http\Models\Title;
use App\Repositories\Interfaces\TitleInterface;

class TitleRepository implements TitleInterface 
{
    private $title;

    public function __construct(Title $title)
    {
        $this->title = $title;
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this->title, $method], $args);
    }

    public function paginate($perPage = 1, $columns = array('*'))
    {
        return $this->title->orderBy('id', 'desc')->paginate($perPage);
    }

    public function all()
    {
        return $this->title->all();
    }

    // @param $key string
    public function get()
    {
        return $this->title->get();
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
            return $this->title->create($data);
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function sort($column = null)
    {
        try {
            return $this->title->orderBy($column)->get();
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function findOrFail($id = null)
    {
        if(isset($id) && (int) $id > 0) {
            try {
                return $this->title->findOrFail($id);
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
                return $this->title->findOrFail($id)->update($data);
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
                return $this->title->findOrFail($id)->delete();
            } catch (Exception $e) {
                echo $e->getMessage();
                die();
            }
        }
    }

}