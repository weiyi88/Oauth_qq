<?php
require_once 'function.php';
require_once 'API/qqConnectAPI.php';

//访问qq登录页面

$oauth=new Oauth();

$oauth->qq_login();