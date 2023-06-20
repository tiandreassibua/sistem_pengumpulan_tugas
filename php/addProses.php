<?php
include "./config.php";
session_start();

if (!empty($_POST)) {
    $idMk = $_POST["namaMk"];
    $linkTugas = $_POST["linkTugas"];
    $namaTugas = $_POST["namaTugas"];

    if (!is_numeric($idMk)) {
        $namaMk = $_POST["namaMk"];
        $sql = "INSERT INTO matakuliah (namaMk) VALUES ('$namaMk')";
        $result = $conn->query($sql);
        $idMk = $conn->insert_id;
    }

    $sql = "INSERT INTO detailtugas (idMk, namaTugas, linkTugas, tglKumpul, idMhs) VALUES ('$idMk', '$namaTugas', '$linkTugas', NOW(), '" . $_SESSION["idMhs"] . "')";
    $result = $conn->query($sql);

    if ($result) {
        echo 'Berhasil kumpul tugas';
    } else {
        echo 'Gagal kumpul tugas';
    }
}
