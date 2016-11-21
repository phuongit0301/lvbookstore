<?php
namespace App\Repositories;

use App\Http\Models\Actor;
use App\Repositories\Interfaces\GeneralInterface;

class ActorRepository implements  GeneralInterface 
{
    private $actor;

    public function __construct(Actor $actor)
    {
        $this->actor = $actor;
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this->actor, $method], $args);
    }

    public function getAllObjects()
    {

    }

    public function getObjectById($openid){
        $token = $this->token->where('openfire_id',$openid)->first();
        if(!empty($token)) {
            $now = new \Datetime();
            $now->sub(new \DateInterval('P7D'));
            $date = $now->getTimestamp();

            //$array = array($date, $token->created_date,$now->getTimestamp());
            if($token->created_date < $date) {
                return $this->updateObjectById($openid);
            } else {
                return $token->token;
            }

        } else {
            return false;
        }
    }

    /**
     * create a token
     * @param $openid
     * @return string
     *
     */
    public function createObject($openid){
        $token = Token::where("openfire_id", $openid)->first();
        if(empty($token)) {
            do {
                $temp = $this->randStr(24);
                $tempToken = DB::table('tokenUser')
                    ->select('id')
                    ->where('token',$temp)
                    ->get();
            } while ($tempToken != null );
            $token = new Token();
            $token->openfire_id = $openid;
            $token->token = $temp;
            $date = new \DateTime();
            $token->created_date = $date->getTimestamp();
            $token->save();
        } else {
            return $this->getObjectById($openid);
        }

        return $token->token;

    }




    public function updateObjectById($openfireId, $data = null){
        $token = Token::where("openfire_id", $openfireId)->first();
        if(!empty($token)) {
            do {
                $temp = $this->randStr(24);
                $tempToken = DB::table('tokenUser')
                    ->select('id')
                    ->where('token',$temp)
                    ->get();
            } while ($tempToken != null );

            $token->token = $temp;
            $date = new \DateTime();
            $token->created_date = $date->getTimestamp();
            $token->save();
        }
        return $token;

    }

    public function checkUserToken($openId, $token) {
        $token = Token::Where([['openfire_id', $openId],['token', $token]])->first();
        if(!empty($token)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkSytemToken($systemToken, $email){
        global $CFG;
        return ($systemToken == sha1($email.$CFG->secrete_string));
    }

    public function getAllStationList(){
        $stations = $this->station->select('region')->distinct()->get();
        $result = array();
        if (!empty($stations)){
            $pops = $this->station->select("name")->orderBy('pop','desc')->take(3)->get();
            if (!empty($pops)) {
                $temp = array();
                foreach($pops as $pop){
                    $temp[] = $pop->name;
                }
                $result['pop'] = $temp;
            }

            foreach ($stations as $station) {
                $regions = $this->station->select('name')->where('region', $station->region)->get();
                if(!empty($regions)) {
                    $temp = array();
                    foreach($regions as $region) {
                        $temp[] = $region->name;
                    }
                    $result[$station->region] = $temp;
                }
            }
        }

        return $result;
    }




    public function saveObject($arg, $con){


    }

    public function getByCondition($arg, $con){

    }



}