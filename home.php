<?php
// Mulai sesi
session_start();

// Periksa apakah user telah melakukan login atau mengakses file tanpa login
// Jika tidak melakukan login, maka arahkan kembali ke form login (index.php)
// Dan jika user telah login, maka tampilkan content
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Nama Aplikasi</title>
    <style>
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 10px;
        }

        .header,
        .footer {
            text-align: center;
            padding: 10px;
        }

        .navigation,
        .content {
            padding: 10px;
            float: left;
        }

        .navigation {
            width: 25%;
        }

        .content {
            width: 70%;
            height: 700px;
            /* Adjust height as needed */
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
            /* Hide iframe border */
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>

<body>
    <!-- Keseluruhan halaman dibungkus ke dalam class container -->
    <div class="container">

        <!-- Menempatkan judul program/ aplikasi pada bagian atas dan posisi berada ditengah -->
        <div class="header">
            <h1>Ini Nama Aplikasi</h1>
        </div>

        <!-- Pada bagian kiri menampilkan seluruh menu yang ada pada program/ aplikasi -->
        <div class="navigation">
            <a href="siswa/list_siswa.php" target="contentFrame">List Siswa</a><br>
            <a href="mata_pelajaran/list_pelajaran.php" target="contentFrame">List Mata Pelajaran</a><br>
            <a href="nilai/list_nilai.php" target="contentFrame">List Nilai</a><br>
            <a href="monitoring.php" target="contentFrame">Monitoring</a><br>
            <a href="logout.php">Logout</a>
        </div>

        <!-- Pada bagian kanan dibuat agar setiap user/ pengguna memilih menu pada bagian kiri (navigation) maka akan menampilkan file pada bagian kanan (content) -->
        <div class="content clearfix">
            <iframe name="contentFrame" src="about:blank"></iframe>
        </div>

        <!-- Bagian kaki (footer), biasanya digunakan sebagai informasi umum -->
        <div class="footer">
            <p>Copyright &copy; 2024</p>
        </div>
    </div>
</body>

</html>