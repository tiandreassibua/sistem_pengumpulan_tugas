<?php
session_start();
if (!isset($_SESSION["username"])) header("Location: ./login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Style untuk body */
        body {
            background-color: #24252A;
            color: #ECEFF4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        /* Style untuk judul */
        h2 {
            color: #ECEFF4;
            margin-bottom: 20px;
        }

        /* Style untuk tombol "Kumpul Tugas" */
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #BD93F9;
            color: #ECEFF4;
            text-decoration: none;
            font-family: Arial, sans-serif;
            font-size: 16px;
            border-radius: 4px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #8BE9FD;
        }

        /* Style untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #3E4452;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ECEFF4;
        }

        th {
            background-color: #6272A4;
            font-weight: bold;
            color: #ECEFF4;
        }

        /* Style untuk link tugas */
        .link-tugas {
            display: inline-block;
            padding: 6px 12px;
            background-color: #FFB86C;
            color: #ECEFF4;
            text-decoration: none;
            font-family: Arial, sans-serif;
            font-size: 14px;
            border-radius: 4px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .link-tugas:hover {
            background-color: #FFA726;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Selamat Datang, <?= $_SESSION["username"] ?></h2>
        <?php if ($_SESSION["role"] != "admin") echo "<a class='button' href='addData.php'>Kumpul Tugas</a>" ?>
        <a class='button' href='php/logout.php'>Logout</a>
        <table>
            <thead>
                <tr>
                    <?php if ($_SESSION["role"] == "admin") echo "<th>Nama Mahasiswa</th>" ?>
                    <th>Nama Matakuliah</th>
                    <th>Nama Tugas</th>
                    <th>Tanggal Kumpul</th>
                    <th>Link Tugas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "./php/config.php";
                $sql = "";
                if($_SESSION["role"] == "admin") {
                    $sql = "SELECT dt.linkTugas, dt.namaTugas, mhs.namaMhs, mk.namaMk, dt.idDetailTugas, dt.tglKumpul FROM detailtugas dt INNER JOIN mahasiswa mhs ON dt.idMhs = mhs.idMhs INNER JOIN matakuliah mk ON dt.idMk = mk.idMk";
                } else {
                    $sql = "SELECT dt.linkTugas, dt.namaTugas, mhs.namaMhs, mk.namaMk, dt.idDetailTugas, dt.tglKumpul FROM detailtugas dt INNER JOIN mahasiswa mhs ON dt.idMhs = mhs.idMhs INNER JOIN matakuliah mk ON dt.idMk = mk.idMk WHERE dt.idMhs = '". $_SESSION["idMhs"] ."'";
                }
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <?php if ($_SESSION["role"] == "admin") echo "<td>". $row["namaMhs"] ."</td>" ?>
                            <td><?= $row["namaMk"] ?></td>
                            <td><?= $row["namaTugas"] ?></td>
                            <td><?= date_format(new DateTime($row["tglKumpul"]), "d M Y") ?></td>
                            <td>
                                <a class="link-tugas" href="<?= $row["linkTugas"] ?>" target="_blank">Lihat tugas</a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="5">Belum ada tugas yang dikumpul</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>