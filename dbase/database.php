<?php
require_once 'dbase/config.php';//this configuration script

$db_conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
mysqli_select_db($db_conn, DB_NAME) or die(mysqli_error());

//this get data from a particular table in a database
//e.g
//getAll('email, phonenumber', 'users', "id='4'")
function getAll($what, $tableName, $where=null)
{
	global $db_conn;
	if($where == null)
	{
		$query = mysqli_query($db_conn, "SELECT  $what  FROM `$tableName`");
		return $query;
	}
	else
	{
		$query = mysqli_query($db_conn, "SELECT  $what  FROM `$tableName` WHERE  $where");
		return $query;
	}
	mysqli_close();
}

//this delete data from a particular table in a database
function delete($tableName, $where=null)
{
	global $db_conn;
	if($where == null)
	{
		$query = mysqli_query($db_conn, "DELETE FROM `$tableName`");
		return $query;
	}
	else
	{
		$query = mysqli_query($db_conn, "DELETE FROM `$tableName` WHERE  $where");
		return $query;
	}
	mysqli_close();
}

//this update a particular table in a database
function update($tableName, $set, $where)
{
	global $db_conn;
	$query = mysqli_query($db_conn, "UPDATE `$tableName` SET $set WHERE  $where");
	return $query;
	mysqli_close();
}

//this insert data into a particular table in a database
function insert($tableName, $rows, $values)
{
	global $db_conn;
	$query = mysqli_query($db_conn, "INSERT INTO `$tableName` ($rows) VALUES ($values)");
	return $query;
	mysqli_close();
}

//get specific value or values from a table in a  database
function getSingle($what, $tableName, $where=null)
{
	$result = getAll($what, $tableName, $where);
	$row = mysqli_fetch_array($result);
	return $row["$what"];
	mysqli_close();
}
function getFirst($tableName, $where=null)
{
	global $db_conn;
	$result = getAll('*', $tableName, $where);
	if ($result != false) {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}
	else {
		return false;
	}
	//mysqli_close($db_conn);
}

//get row count of a particular table in a database
function getCount($tableName, $where=null)
{
	$result = getAll('*', $tableName, $where);
	return mysqli_num_rows($result);
	mysqli_close();
}

