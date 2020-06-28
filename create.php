<?php




$email = 'demo_email@email.com';
$password = md5('password_demo');
$phone = md5("0961728082");


$sql = mysqli_connect('localhost', 'root', '', 'demo');


$count = mysqli_query($sql, "SELECT MAX(id) FROM users");
$count = (int) mysqli_fetch_array($count)["MAX(id)"] + 1;
$query = "INSERT INTO users VALUES (". $count .", '".$email."', '".$password."', '".$phone."')";
var_dump(mysqli_query($sql, $query));
?>