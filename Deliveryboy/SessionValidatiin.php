<?php
session_start();
if(!$_SESSION['dbid'])
{
header('location:../Guest/Login.php');
} 
?>