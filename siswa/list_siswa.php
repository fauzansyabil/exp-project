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

    // Script PHP jika link Delete di klik
    if (isset($_GET["id"])) {

        // Ambil variabel id yang ada pada link delete
        $id = $_GET['id'];

        // Query delete data siswa berdasarkan id (primary key)
        $sql = "DELETE FROM siswa WHERE id=$id";

        // Jika perintah delete berhasil, maka kembali ke halaman list siswa
        if ($conn->query($sql) === TRUE) {
            // header("Location: http://localhost/sekolah/siswa/list_siswa.php");
            echo "<script lang='javascript'>
                alert('Data telah dihapus');
                window.location.href = 'list_siswa.php'; // Ganti dengan file tujuan
              </script>";
        }

        // Jika perintah delete tidak berhasil, maka tampilkan error system
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Tutup fungsi koneksi
        $conn->close();
    }

    // Query untuk menampilkan data siswa
    $sql = "SELECT * FROM siswa";
    $result = $conn->query($sql);

    // Jika ada data pada tabel siswa
    if ($result->num_rows > 0) {
        echo
        "<table>
        <tr>
            <td colspan='5'><a href='" . ('create_siswa.php') . "'>Tambah Siswa</a></td>
        </tr>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Action</th>
        </tr>";

        // Buat variabel i untuk mendapatkan no urut tabel
        $i = 1;

        // Buat fungsi looping untuk menampilkan data dari database
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $i . "</td>
            <td>" . $row["nama_siswa"] . "</td>
            <td>" . $row["tempat_lahir"] . "</td>
            <td>" . date("d-m-Y", strtotime($row["tanggal_lahir"])) . "</td>
            <td><a href='" . ('update_siswa.php?id=' . $row["id"]) . "'>Update</a> || <a href='" . ('list_siswa.php?id=' . $row["id"]) . "'>Delete</a></td>
            </tr>";

            // Buat agar nilai i selalu bertambah 1 pada setiap baris/ looping
            $i++;
        }
        echo "</table>";
    }

    // Jika tidak ada data pada tabel siswa 
    else {
        echo "0 results <br><br>";
        echo "<a href='" . ('create_siswa.php') . "'>Tambah Siswa</a>";
    }

    // Tutup fungsi koneksi
    $conn->close();
    ?>

</body>

</html>