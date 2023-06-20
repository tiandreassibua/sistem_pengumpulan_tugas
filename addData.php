<?php
session_start();

if ($_SESSION["role"] == "admin") header("Location: ./index.php");
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
            background-color: #222222;
            color: #FFFFFF;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        /* Style untuk judul */
        h2 {
            color: #FFFFFF;
            margin-bottom: 20px;
        }

        /* Style untuk tombol "Kembali" */
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4285F4;
            color: #FFFFFF;
            text-decoration: none;
            font-family: Arial, sans-serif;
            font-size: 16px;
            border-radius: 4px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #3367D6;
        }

        /* Style untuk form */
        form {
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            padding: 10px;
        }

        td:first-child {
            width: 150px;
        }

        /* Style untuk select box */
        select,
        input[type="text"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #CCCCCC;
            width: 100%;
            box-sizing: border-box;
            background-color: #333333;
            color: #FFFFFF;
        }

        /* Style untuk tombol "Kumpul" */
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #34A853;
            color: #FFFFFF;
            text-decoration: none;
            font-family: Arial, sans-serif;
            font-size: 16px;
            border-radius: 4px;
            border: none;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #1E7C33;
        }

        /* Style untuk pesan sukses atau gagal */
        .message {
            margin-top: 20px;
            padding: 10px;
            font-weight: bold;
        }

        .success {
            background-color: #4CAF50;
            color: #FFFFFF;
        }

        .error {
            background-color: #F44336;
            color: #FFFFFF;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Pengumpulan Tugas</h2>
        <a class="button" href="index.php">Kembali</a>

        <form action="" method="POST">
            <input type="hidden" id="idMhs" value="<?= $_SESSION["idMhs"] ?>">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $_SESSION["username"] ?></td>
                </tr>
                <tr>
                    <td>Mata Kuliah</td>
                    <td>:</td>
                    <td>
                        <select name="idMk" id="optionMk">
                            <?php
                            include "./php/config.php";
                            $sql = "SELECT * FROM matakuliah";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($mk = $result->fetch_assoc()) {
                            ?>
                                    <option value="<?= $mk["idMk"] ?>"><?= $mk["namaMk"] ?></option>
                            <?php }
                            } ?>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </td>
                </tr>
                <tr id="matkulLainnya" style="display: none;">
                    <td></td>
                    <td></td>
                    <td>
                        <input type="text" placeholder="Masukan nama matakuliah" name="namaMatkulLainnya" id="namaMatkulLainnya" required>
                    </td>
                </tr>
                <tr>
                    <td>Nama Tugas</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="namaTugas" id="namaTugas">
                    </td>
                </tr>
                <tr>
                    <td>Link tugas</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="linkTugas" id="linkTugas">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="submit" value="Kumpul" id="simpan">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        const optionMk = document.getElementById("optionMk");
        const matkulLainnya = $("#matkulLainnya");
        const namaMatkulLainnya = $("#namaMatkulLainnya");
        const btnSimpan = $("#simpan");

        let namaMk = optionMk.value;
        optionMk.addEventListener("change", () => {
            if (optionMk.value === "lainnya") {
                matkulLainnya.show();
            } else {
                matkulLainnya.hide();
            }
        });


        btnSimpan.click(function(e) {
            e.preventDefault();
            const namaTugas = $("#namaTugas").val();
            const linkTugas = $("#linkTugas").val();

            namaMk = optionMk.value === "lainnya" ? namaMatkulLainnya.val() : optionMk.value;

            const data = {
                namaMk,
                namaTugas,
                linkTugas
            };
            $.ajax({
                url: "./php/addProses.php",
                method: "POST",
                data: data,
                success: function(response) {
                    alert(response);
                    window.location.href = "./index.php";
                }
            });
        });
    </script>
</body>

</html>