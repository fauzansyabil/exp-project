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

        tfoot {
            background-color: #f9f9f9;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php
    // Pemanggilan file koneksi.php pada folder koneksi
    include 'koneksi/koneksi.php';
    ?>

    <form method="post" action="<?php $_SERVER["PHP_SELF"] ?>" style="margin-bottom: 25px;">
        Nama Siswa:
        <select name="siswa_id">
            <option value="-">Pilih</option>
            <?php
            // Query untuk menampilkan data siswa
            $sql = "SELECT * FROM siswa";
            $result = $conn->query($sql);

            // Buat fungsi looping untuk menampilkan data dari database
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["nama_siswa"] . "</option>";
            }
            ?>
        </select>

        Mata Pelajaran:
        <select name="pelajaran_id">
            <option value="-">Pilih</option>
            <?php
            // Query untuk menampilkan data mata pelajaran
            $sql = "SELECT * FROM mata_pelajaran";
            $result = $conn->query($sql);

            // Buat fungsi looping untuk menampilkan data dari database
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["nama_pelajaran"] . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Cari">
    </form>

    <?php
    // Jika form telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $siswa_id = $_POST['siswa_id'];
        $pelajaran_id = $_POST['pelajaran_id'];

        // Buat query dengan kondisi filter berdasarkan input pengguna
        $sql = "SELECT * FROM vw_nilai WHERE 1=1";

        if ($siswa_id != "-") {
            $sql .= " AND siswa_id = $siswa_id";
        }

        if ($pelajaran_id != "-") {
            $sql .= " AND pelajaran_id = $pelajaran_id";
        }
    } else {
        // Query untuk menampilkan semua data nilai jika form tidak disubmit
        $sql = "SELECT * FROM vw_nilai";
    }

    $result = $conn->query($sql);

    // Jika ada data pada tabel nilai
    if ($result->num_rows > 0) {
        echo
        "<table>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Mata Pelajaran</th>
            <th>Nilai</th>
        </tr>";

        // Buat variabel i untuk mendapatkan no urut tabel
        $i = 1;
        $total_nilai = 0;

        // Buat fungsi looping untuk menampilkan data dari database
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $i . "</td>
            <td>" . $row["nama_siswa"] . "</td>
            <td>" . $row["nama_pelajaran"] . "</td>
            <td>" . $row["nilai"] . "</td>
            </tr>";

            // Hitung total nilai
            $total_nilai += $row["nilai"];

            // Buat agar nilai i selalu bertambah 1 pada setiap baris/ looping
            $i++;
        }

        // Hitung rata-rata nilai
        $rata_rata = $total_nilai / ($i - 1);

        // Tampilkan total nilai dan rata-rata di footer tabel
        echo "<tfoot>
                <tr>
                    <td colspan='3'>Total Nilai</td>
                    <td>" . $total_nilai . "</td>
                </tr>
                <tr>
                    <td colspan='3'>Rata-Rata Nilai</td>
                    <td>" . number_format($rata_rata, 2) . "</td>
                </tr>
              </tfoot>";
        echo "</table>";
    }

    // Jika tidak ada data pada tabel nilai 
    else {
        echo "0 results <br><br>";
        echo "<a href='create_nilai.php'>Tambah Nilai</a>";
    }

    // Tutup fungsi koneksi
    $conn->close();
    ?>

</body>

</html>