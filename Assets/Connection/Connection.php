<?php
$ServerName='localhost';
$UserName='root';
$Password='';
$Database='db_medstore';

$Con=mysqli_connect($ServerName,$UserName,$Password,$Database);

if(!$Con)
{
	echo "failed to connect";
}
?>