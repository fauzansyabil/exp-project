<?php
// Pemanggilan file koneksi.php pada folder koneksi
include '../koneksi/koneksi.php';

// Jika terdapat method get maka jalankan perintah berikut
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    // Ambil variabel id yang ada pada link update
    $id = $_GET['id'];

    // Query menampilkan data siswa berdasarkan id (primary key)
    $sql = "SELECT * FROM siswa WHERE id=$id";
    $result = $conn->query($sql);

    // Jika ada data pada tabel siswa
    if ($result->num_rows > 0) {

        // Buat fungsi looping untuk menampilkan data dari database di dalam sebuah form update
        while ($row = $result->fetch_assoc()) {

            // Form update data siswa
            echo
            "<form method='post' action='update_siswa.php'>
                ID: <input type='text' name='id' value='" . $row['id'] . "' readonly><br>
                Nama Siswa: <input type='text' name='nama_siswa' value='" . $row['nama_siswa'] . "'><br>
                Tempat Lahir: <input type='text' name='tempat_lahir' value='" . $row['tempat_lahir'] . "'><br>
                Tanggal Lahir: <input type='date' name='tanggal_lahir' value='" . $row['tanggal_lahir'] . "'><br>
                <input type='submit' value='Update'>
                <a href='list_siswa.php'>Kembali</a>
            </form>";
        }
    }

    // Jika tidak ada data pada tabel siswa berdasarkan id yang di dapat
    else {
        echo "data not found";
    }

    // Tutup fungsi koneksi
    $conn->close();
}

// Jika ada method lain yang digunakan pada halaman ini
// Contoh pada kasus ini; jika terdapat method post pada halaman ini maka jalankan perintah berikut
elseif ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Deklarasikan varibel yang digunakan untuk mengambil value dari form update
    $id = $_POST['id'];
    $nama_siswa = $_POST['nama_siswa'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    // Query update data siswa berdasarkan id 
    $sql = "UPDATE siswa SET nama_siswa='$nama_siswa', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir' WHERE id=$id";

    // Jika perintah update berhasil, maka kembali ke halaman list siswa
    if ($conn->query($sql) === TRUE) {
        // header("Location: http://localhost/sekolah/siswa/list_siswa.php");
        echo "<script lang='javascript'>
                alert('Data telah diupdate');
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
