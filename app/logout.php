<?php 

session_unset();
session_destroy();

require_once('../functions.php');
redirect('login');
die();
