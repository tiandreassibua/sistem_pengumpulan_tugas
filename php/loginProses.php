<?php

include "./config.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM mahasiswa WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $row["namaMhs"];
        $_SESSION["idMhs"] = $row["idMhs"];
        $_SESSION["role"] = $row["role"];
        echo true;
    } else {
        echo "Username atau password salah";
    }
}