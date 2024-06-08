<?php
// Pemanggilan file koneksi.php pada folder koneksi
include '../koneksi/koneksi.php';

// Jika terdapat method post maka jalankan perintah berikut
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Deklarasikan varibel yang digunakan untuk mengambil value dari form create
    $siswa_id = $_POST['siswa_id'];
    $pelajaran_id = $_POST['pelajaran_id'];
    $nilai = $_POST['nilai'];

    // Query insert untuk menyimpan data siswa ke dalam database
    $sql = "INSERT INTO nilai (siswa_id, pelajaran_id, nilai) VALUES ('$siswa_id', '$pelajaran_id', '$nilai')";

    // Jika perintah update berhasil, maka kembali ke halaman list nilai
    if ($conn->query($sql) === TRUE) {
        // header("Location: http://localhost/sekolah/nilai/list_nilai.php");
        echo "<script lang='javascript'>
                alert('Data telah disimpan');
                window.location.href = 'list_nilai.php'; // Ganti dengan file tujuan
                exit;
            </script>";
    }

    // Jika perintah update tidak berhasil, maka tampilkan error system
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup fungsi koneksi
    $conn->close();
}
?>
<form method="post" action="create_nilai.php">
    ID Siswa: <select name="siswa_id">
        <?php
        // Query untuk menampilkan data siswa
        $sql = "SELECT * FROM siswa";
        $result = $conn->query($sql);

        // Buat fungsi looping untuk menampilkan data dari database
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["id"] . "'>" . $row["nama_siswa"] . "</option>";
        }
        ?>
    </select><br>

    ID Pelajaran: <select name="pelajaran_id">
        <?php
        // Query untuk menampilkan data siswa
        $sql = "SELECT * FROM mata_pelajaran";
        $result = $conn->query($sql);

        // Buat fungsi looping untuk menampilkan data dari database
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["id"] . "'>" . $row["nama_pelajaran"] . "</option>";
        }
        ?>
    </select><br>

    Nilai: <input type="number" name="nilai" required><br>
    <input type="submit" value="Submit">
    <a href='list_nilai.php'>Kembali</a>
</form>