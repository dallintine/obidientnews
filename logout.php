<?php
require_once 'helper/autoload.php';
session_start();
unset($_SESSION['email']);
unset($_SESSION['phone']);
header('Location: index');
