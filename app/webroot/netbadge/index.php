<?php

// is it set?
if ( !isset($_SERVER['REMOTE_USER']) || ($_SERVER['REMOTE_USER']=="") ) {
  die ("No REMOTE_USER is set!");
 }
$username = $_SERVER['REMOTE_USER'];
//$username = "mst3k"; // for debugging!

// database login
if ( !mysql_pconnect('localhost', 'dbuser', 'dbpass') )
  die('Could not connect: ' . mysql_error());
mysql_select_db("dbname");

// is the user in the users table?
$query = "select * from users where username='$username'";
$result = mysql_query($query);
$num = mysql_numrows($result);
if ( $num > 1 )
  die("There are " . mysql_numrows($query) . " users with that username!");

// if not, put them there as an observer
if ( $num == 0 ) {
  $query = "insert into users set first_name='', last_name='', username='$username', email='$username@virginia.edu', role='observer', created=now()";
  mysql_query($query);
 }

// get their user id
$query = "select * from users where username='$username'";
$result = mysql_query($query);
if ( mysql_numrows($result) != 1 )
  die ("Error creating user account!");
$id = mysql_result($result,0,"id");

// invalidate their other authentication entries
$query = "update authentications set valid=false where user_id=$id";
mysql_query($query);

// create a new (valid) auth entry
$uniqid = uniqid("",true);
$ipaddr = $_SERVER['REMOTE_ADDR'];
$query = "insert into authentications set user_id=$id, ipaddr='$ipaddr', value='$uniqid', valid=true, created=now()";
mysql_query($query);

// set the auth entry as a cookie
setcookie("REMOTE_AUTH",$uniqid,0,"/~foobar");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html><head>
<meta http-equiv="refresh" content="0; URL=/~foobar/users/netbadge">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Netbadge redirect page</title>
</head>
<?php $_SESSION['REMOTE_USER'] = $_SERVER['REMOTE_USER']; ?>
<p>You really want to be <a href="/~foobar/users/netbadge">here</a>; redirecting now…</p>
</body></html>