<?php
session_start();
if(!$_SESSION['pid'])
{
header('location:../Guest/Login.php');
} 
?>