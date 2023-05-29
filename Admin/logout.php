<?php
include('../function.inc.php');
session_start();
unset($_SESSSION['IS_LOGIN']);
redirect('login.php');


?>