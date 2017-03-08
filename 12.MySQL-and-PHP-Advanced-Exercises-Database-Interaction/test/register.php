<?php
require_once 'app.php';
if (isset($_GET['register'])) {
    $name = $_GET['name'];
    $pass = $_GET['password'];
    $confirm = $_GET['confirm'];
    if ($pass != $confirm) {
        throw new Exception("Passwords mismatch");
    }


    $stmt = $db->prepare("SELECT *FROM users WHERE name=?");
    $stmt->execute(
        [
            $name

        ]
    );
    $result = $stmt->fetchRow();
    if ($result) {
        throw new Exception("Name already exists");
    }
    $stmt = $db->prepare("
            INSERT INTO users
                        (`name`,`password`) 
            VALUES (:username,:password)");
    $sucess = $stmt->execute(
        [
            'username' => $name,
            'password' => $pass

        ]
    );
    if (!$sucess) {
        throw new Exception("Sorry, problem!");
    }

}