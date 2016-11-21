<?php

/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 22/1/2016
 * Time: 10:47
 */
global $CFG;
$CFG = new \stdClass();

$CFG->userServiceURL = "http://localhost:9090/plugins/userService/userservice";

$CFG->mailerHost = "smtp.dotster.com";
$CFG->mailerPort = 25; // or 587
$CFG->mailerUsername = "user name";
$CFG->mailerPassword = "you password";
$CFG->mailerFrom="email";
$CFG->secrete_string= "CommuneNow";


?>