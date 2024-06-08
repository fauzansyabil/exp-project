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
    $sql = "SELECT * FROM mata_pelajaran";
    $result = $conn->query($sql);

    // Jika ada data pada tabel mata pelajaran
    if ($result->num_rows > 0) {
        echo
        "<table>
        <tr>
            <td colspan='5'><a href='" . ('create_pelajaran.php') . "'>Tambah Mata Pelajaran</a></td>
        </tr>
        <tr>
            <th>No</th>
            <th>Mata Pelajaran</th>
            <th>Action</th>
        </tr>";

        // Buat variabel i untuk mendapatkan no urut tabel
        $i = 1;

        // Buat fungsi looping untuk menampilkan data dari database
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $i . "</td>
            <td>" . $row["nama_pelajaran"] . "</td>
            <td><a href='" . ('update_pelajaran.php?id=' . $row["id"]) . "'>Update</a> || <a href='" . ('list_pelajaran.php?id=' . $row["id"]) . "'>Delete</a></td>
            </tr>";

            // Buat agar nilai i selalu bertambah 1 pada setiap baris/ looping
            $i++;
        }
    } else {
        echo "0 results <br><br>";
        echo "<a href='" . ('create_pelajaran.php') . "'>Tambah Mata Pelajaran</a>";
    }
    $conn->close();
    ?>

</body>

</html>