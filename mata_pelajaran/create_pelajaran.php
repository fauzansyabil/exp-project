<?php
include '../koneksi/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pelajaran = $_POST['nama_pelajaran'];

    $sql = "INSERT INTO mata_pelajaran (nama_pelajaran) VALUES ('$nama_pelajaran')";

    if ($conn->query($sql) === TRUE) {
        echo "New subject created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<form method="post" action="create_pelajaran.php">
    Nama Pelajaran: <input type="text" name="nama_pelajaran"><br>
    <input type="submit" value="Submit">
    <a href='list_pelajaran.php'>Kembali</a>
</form>