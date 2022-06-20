<?php
/** @var mysqli $db */

require_once "connect.php";

$password = password_hash('inlogcode', PASSWORD_DEFAULT);           //beveilig wachtwoord
$username = 'Joey Randsdorp';                                                   //bepaal inloggegevens
$Email = 'joeys.email@gmail.com';
$Admin_Status = true;

$query = "INSERT INTO account (Customer_ID, Username, Password, Email, Admin_Status)      /*zet inloggevens in database*/
                      VALUES ('','$username','$password', '$Email','$Admin_Status')";
$result = mysqli_query($db, $query);
