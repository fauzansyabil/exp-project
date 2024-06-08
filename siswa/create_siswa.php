<?php
// Pemanggilan file koneksi.php pada folder koneksi
include '../koneksi/koneksi.php';

// Jika terdapat method post maka jalankan perintah berikut
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Deklarasikan varibel yang digunakan untuk mengambil value dari form create
    $nama_siswa = $_POST['nama_siswa'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    // Query insert untuk menyimpan data siswa ke dalam database
    $sql = "INSERT INTO siswa (nama_siswa, tempat_lahir, tanggal_lahir) VALUES ('$nama_siswa', '$tempat_lahir', '$tanggal_lahir')";

    // Jika perintah update berhasil, maka kembali ke halaman list siswa
    if ($conn->query($sql) === TRUE) {
        // header("Location: http://localhost/sekolah/siswa/list_siswa.php");
        echo "<script lang='javascript'>
                alert('Data telah disimpan');
                window.location.href = 'list_siswa.php'; // Ganti dengan file tujuan
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

<!-- Form create data siswa -->
<form method="post" action="create_siswa.php">
    Nama Siswa: <input type="text" name="nama_siswa"><br>
    Tempat Lahir: <input type="text" name="tempat_lahir"><br>
    Tanggal Lahir: <input type="date" name="tanggal_lahir"><br>
    <input type="submit" value="Submit">
    <a href="list_siswa.php">Kembali</a>
</form>