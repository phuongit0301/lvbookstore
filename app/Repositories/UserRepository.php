<?php
namespace App\Repositories;

use App\Http\Models\User;
use App\Repositories\Interfaces\UserInterface;

class UserRepository implements UserInterface 
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this->user, $method], $args);
    }

    public function paginate($perPage = 1, $columns = array('*'))
    {
        return $this->user->orderBy('id', 'desc')->paginate($perPage);
    }

    public function all()
    {
        return $this->user->all();
    }

    // @param $key string
    public function get()
    {
        return $this->user->get();
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
            return $this->user->create($data);
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function sort($column = null)
    {
        try {
            return $this->user->orderBy($column)->get();
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function findOrFail($id = null)
    {
        if(isset($id) && (int) $id > 0) {
            try {
                return $this->user->findOrFail($id);
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
                return $this->user->findOrFail($id)->update($data);
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
                return $this->user->findOrFail($id)->delete();
            } catch (Exception $e) {
                echo $e->getMessage();
                die();
            }
        }
    }

}