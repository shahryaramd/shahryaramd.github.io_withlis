<?php
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
if(!mysql_connect("localhost","root","12345678"))
{
	die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db("shutdown_places"))
{
	die('oops database selection problem ! --> '.mysql_error());
}

?>