<?php



$access_token = '';
$user_id = 'email@gmail.com';

$query = 'https://graph.facebook.com/search?q=' . $user_id . '&type=user&access_token=' . $access_token;

$ch = curl_init(); // open curl session

echo $query;
// set curl options
curl_setopt($ch, CURLOPT_URL, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch); // execute curl session
curl_close($ch); // close curl session
var_dump(json_decode($data));