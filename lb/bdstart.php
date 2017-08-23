<?php
function bdstart()
{
	$hostname = 'localhost';	
	$username = 'root'; 
	$password = '';
	$dbName   = 'rosseta';
	
	setlocale(LC_ALL, 'utf-8_general_ci');	
	
	mysql_connect($hostname, $username, $password) or die('No connect with data base'); 
	mysql_query('SET NAMES utf-8_general_ci');
	mysql_select_db($dbName) or die('No data base');
	
	session_start();		
}
?>