<?php

require 'header.php';
session_start();
$_SESSION["_ID"] = "'";


if (count($_POST) > 0) {
    $sql = "SELECT *from users WHERE id='" . $_SESSION["id"] . "'";
    $stmt = $newpdo->prepare($sql);
    if ($_POST["password"] == $row["password"]) {
        $sql= "UPDATE users set password='" . $_POST["newPassword"] . "' WHERE id='" . $_SESSION["id"] . "'";
        $stmt= $newpdo->prepare($sql);
        $message = "Password Changed";
    } else
        $message = "Current Password is not correct";
}

?>



