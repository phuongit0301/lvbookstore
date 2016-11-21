<?php 
	error_reporting(E_ALL);
 	ini_set("display_errors", 1);
    ini_set('default_charset', 'UTF-8');
	 header('Content-Type: text/html; charset=UTF-8');
	include('config.php');

	$input = mysql_real_escape_string(isset($_REQUEST['input'])?$_REQUEST['input']:''); 
    $proc  = isset($_REQUEST['proc'])?$_REQUEST['proc']:'';
    $jid   = mysql_real_escape_string(isset($_REQUEST['id'])?$_REQUEST['id']:'');

    if ($proc != ''){
    	if ($input != ''){
    		if ($proc == 'new'){
    			newUser($input);
    		}
    		else if ($proc == 'get'){
                if ($jid == '')
    			   getJIDByEmailUsername($input);
                else
                   getInfoByJID($jid);
    		}
    		else if ($proc == 'set'){
    			if ($jid != ''){
    				setUsernameByJID($jid, $input);
    			}
    		}else if ($proc == 'suggest'){
                getSuggestedFriendsByEmail($input);
            }else if ($proc == 'checkemails'){
                getCoboUsersByEmail($input);
            }
    	}
    	else{
    		$content=array("code"=>GENERAL_ERROR,
	                   	   "message"=>"Invalid Input",
	                   	   "type"=>"error",
	                   	   "result"=>"");
    	}
    }
    else{
    	$content=array("code"=>GENERAL_ERROR,
	                   	   "message"=>"No Process Selected",
	                   	   "type"=>"error",
	                   	   "result"=>"");
    }

    echo json_encode($content);

    //INSERTS NEW USER ON THE DATABASE AND RETURNS NEWLY CRATED JID
    //============================================================================
    function newUser($email){
    	$sql="SELECT id FROM cobouser WHERE email = '". $email ."'";
    	$res=mysql_query($sql) or die("SQL ERROR : " . mysql_error() . "<br/>" . $sql);
    	
    	if(mysql_num_rows($res)==0){
    		//GENERATE A RANDOM STRING AND CHECK IT AGAINST THE DATABASE
    		do{
    			$newid = randStr(4) . '-' . randStr(5) . '-' . randStr(6) . '-' . randStr(7);
    			$sql="SELECT id FROM cobouser WHERE JID='" . $newid . "'";
    			$res=mysql_query($sql) or die("SQL ERROR : " .mysql_error());
    		}while (mysql_num_rows($res));

    		//INSERT THE RECORD
    		$sql="INSERT INTO cobouser (username,email,JID) VALUES('','" . $email . "', '" . $newid . "')";
    		$res=mysql_query($sql) or die("SQL ERROR : " .mysql_error());
    		$content=array("code"=>SUCCESS_CODE,
	                   	   "message"=>SUCCESS_MSG,
	                   	   "type"=>"newrecord",
	                   	   "result"=>$newid);

    	}
    	else{
    		$content=array("code"=>DUPLICAT_CODE,
	                   	   "message"=>"Email already exist",
	                   	   "type"=>"error",
	                   	   "result"=>"");
    	}

    	echo json_encode($content);
    	exit;
    }


    //GETS THE JID BY PASSING EMAIL
    //============================================================================
    function getJIDByEmailUsername($inp){

    	$sql="SELECT JID, email, username FROM cobouser WHERE email = '". $inp ."' or username = '". $inp ."'";
        $res=mysql_query($sql) or die("SQL ERROR : " .mysql_error());

    	if(mysql_num_rows($res)){
    		$data=mysql_fetch_row($res);
      		$jid = $data[0];
            $email = $data[1];
            $username = $data[2];

            $sql="SELECT name FROM ofUser WHERE username = '". $jid ."';";
            $tmp=mysql_query("SET NAMES utf8;");
            //$tmp=mysql_query('SET character_set_results=utf8');
            $res2=mysql_query($sql) or die("SQL ERROR : " .mysql_error());

            $displayname='';

            if (mysql_num_rows($res2)){
                $data=mysql_fetch_row($res2);
                $displayname = $data[0];
            }

      		$content=array("code"=>SUCCESS_CODE,
	                   	   "message"=>SUCCESS_MSG,
	                   	   "type"=>"getidbyemailorusername",
	                   	   "result"=>$jid,
                           "displayname"=>$displayname,
                           "email" => $email,
                           "username" => $username);

	    }
	    else{
	    	$content=array("code"=>NOT_FOUND_ERROR,
	                   	   "message"=>"Email or Username not found",
	                   	   "type"=>"error",
	                   	   "result"=>"");
	    }
       
        print('<html><head>');
        print('<meta http-equiv="Content-Type"'.
                ' content="text/html; charset=UTF-8"/>');
        print('</head><body>'."\n");
        
        echo json_encode($content);
        echo utf8_encode($displayname);
        echo $displayname;
        print('</body></html>');
    	exit;
    }

    //SETS USERNAME BY PASSING JID
    //============================================================================
    function setUsernameByJID($jID,$username){
    	$sql="SELECT id FROM cobouser WHERE JID = '". $jID ."'";
    	$res=mysql_query($sql) or die("SQL ERROR : " .mysql_error());

    	if(mysql_num_rows($res)){

            $sql="SELECT id FROM cobouser WHERE username = '". $username ."'";
            $res=mysql_query($sql) or die("SQL ERROR : " .mysql_error());

            if(!mysql_num_rows($res)){
                $sql="UPDATE cobouser SET username = '" . $username . "' WHERE JID = '" . $jID . "'";
                $res=mysql_query($sql) or die("SQL ERROR : " .mysql_error());

                $content=array("code"=>SUCCESS_CODE,
                               "message"=>SUCCESS_MSG,
                               "type"=>"setuserbyid",
                               "result"=>$username);    
            }
            else{
                $content=array("code"=>DUPLICAT_CODE,
                               "message"=>"Username already exists",
                               "type"=>"error",
                               "result"=>"");  
            }            
    		
	    }
	    else{
	    	$content=array("code"=>NOT_FOUND_ERROR,
	                   	   "message"=>"JID not found",
	                   	   "type"=>"error",
	                   	   "result"=>"");
	    }

	    echo json_encode($content);
    	exit;
    }

    
    //GETS THE JID BY PASSING EMAIL
    //============================================================================
    function getInfoByJID($inp){
        $sql="SELECT email, username FROM cobouser WHERE JID = '". $inp ."'";
        $res=mysql_query($sql) or die("SQL ERROR : " .mysql_error());

        if(mysql_num_rows($res)){
            $data=mysql_fetch_row($res);
            $result = $data[0] . "|" . $data[1];
            $content=array("code"=>SUCCESS_CODE,
                           "message"=>SUCCESS_MSG,
                           "type"=>"getInfoByJID",
                           "result"=>$result);

        }
        else{
            $content=array("code"=>NOT_FOUND_ERROR,
                           "message"=>"Email or Username not found",
                           "type"=>"getInfoByJID",
                           "result"=>"");
        }

        echo json_encode($content);
        exit;
    }

    //GENERATE JSON ARRAY FOR SUGGESTED FRIEND (queries friends with the same email domain)
    //============================================================================
    function getSuggestedFriendsByEmail($inp){
        $domain = strstr($inp, "@");
        //echo $domain;
        if ($domain == ''){
            $content=array("code"=>GENERAL_ERROR,
                           "message"=>"Invalid Input! Mal-formed email",
                           "type"=>"error",
                           "result"=>"");
            echo json_encode($content);
            exit;
        }

        $emaildomains = array("GMAIL.COM",
                            "YAHOO.COM",
                            "HOTMAIL.COM",
                            "AOL.COM",
                            "SINGNET.SG"
                            );
        $resultarray = array();

        if (in_array(strtoupper($domain), $emaildomains)){
            $content=array("code"=>GENERAL_ERROR,
                       "message"=>"EMAIL DOMAIN FILTERED",
                       "type"=>"getSuggestedFriendsByEmail",
                       "result"=>$resultarray);
             echo json_encode($content);
             exit;
        }

        $sql="SELECT email, username, name FROM ofUser WHERE email like '%". $domain ."' AND username NOT IN('admin','parrot') AND email <> '" . $inp . "'";
        $tmp=mysql_query('SET CHARACTER SET utf8');
        $res=mysql_query($sql) or die("SQL ERROR : " .mysql_error());
        
        if (mysql_num_rows($res))
        {
            while ($row = mysql_fetch_assoc($res)){
                $resultarray[] = $row;
            }
        }

        $content=array("code"=>SUCCESS_CODE,
                       "message"=>SUCCESS_MSG,
                       "type"=>"getSuggestedFriendsByEmail",
                       "result"=>$resultarray);

        echo utf8_encode(json_encode($content));
        exit;

    }


    function getCoboUsersByEmail($inp){

        $strRes = '';

        if (strpos($inp, ',')){
            $emails = explode(",", $inp);
            for ($i=0;$i<count($emails);$i++){
                if ($strRes != '')
                    $strRes .=",";
                $strRes .= "'" . $emails[$i] . "'";
            }
        }else{
            $strRes = "'" . $inp . "'";
        }

        $sql="SELECT email, username, name FROM ofUser WHERE email IN (". $strRes .") AND username NOT IN('admin','parrot')";
        
        //echo "<br/>" . $sql . "<br/>";
        $res=mysql_query($sql) or die("SQL ERROR : " .mysql_error());

        $resultarray = array();
        if (mysql_num_rows($res))
        {
            while ($row = mysql_fetch_assoc($res)){
                $resultarray[] = $row;
            }
        }

        $content=array("code"=>SUCCESS_CODE,
                       "message"=>SUCCESS_MSG,
                       "type"=>"getSuggestedFriendsByEmail",
                       "result"=>$resultarray);
        echo utf8_encode(json_encode($content));
        exit;
    }


    //GENERATE RANDOM STRING WITH length
    //============================================================================
    function randStr($length) {
	    $key = '';
	    $keys = array_merge(range(0, 9), range('a', 'z'));

	    for ($i = 0; $i < $length; $i++) {
	        $key .= $keys[array_rand($keys)];
	    }

	    return $key;
	}


	
?>