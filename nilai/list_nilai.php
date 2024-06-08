<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <?php
    // Pemanggilan file koneksi.php pada folder koneksi
    include '../koneksi/koneksi.php';

    // Query untuk menampilkan data nilai
    $sql = "SELECT * FROM `vw_nilai`";
    $result = $conn->query($sql);

    // Jika ada data pada tabel nilai
    if ($result->num_rows > 0) {
        echo
        "<table>
        <tr>
            <td colspan='5'><a href='" . ('create_nilai.php') . "'>Tambah Nilai</a></td>
        </tr>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Mata Pelajaran</th>
            <th>Nilai</th>
            <th>Action</th>
        </tr>";

        // Buat variabel i untuk mendapatkan no urut tabel
        $i = 1;

        // Buat fungsi looping untuk menampilkan data dari database
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $i . "</td>
            <td>" . $row["nama_siswa"] . "</td>
            <td>" . $row["nama_pelajaran"] . "</td>
            <td>" . $row["nilai"] . "</td>
            <td><a href='" . ('update_nilai.php?id=' . $row["id"]) . "'>Update</a> || <a href='" . ('list_nilai.php?id=' . $row["id"]) . "'>Delete</a></td>
            </tr>";

            // Buat agar nilai i selalu bertambah 1 pada setiap baris/ looping
            $i++;
        }
        echo "</table>";
    }

    // Jika tidak ada data pada tabel nilai 
    else {
        echo "0 results <br><br>";
        echo "<a href='" . ('create_nilai.php') . "'>Tambah Nilai</a>";
    }

    // Tutup fungsi koneksi
    $conn->close();
    ?>

</body>

</html>