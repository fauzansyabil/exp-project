<?php
// Mulai sesi
session_start();

// Periksa apakah user telah melakukan login
// Jika belum melakukan login, maka tampilkan form login (index.php)
// Dan jika user telah login, maka alihkan ke file home.php
if (isset($_SESSION['loggedin']) == true) {
    header("Location: home.php");
    exit;
}

// Jika terdapat method post maka jalankan perintah berikut
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pemanggilan file koneksi.php pada folder koneksi
    include 'koneksi/koneksi.php';

    // Ambil username dan password dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Siapkan dan jalankan perintah SQL untuk mencari user
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Cek apakah user ditemukan
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $username, $hashed_password); // hash fungsi untuk enkrip data
        if ($stmt->fetch()) {
            // Cek apakah password yang dimasukkan sesuai
            if ($password == $hashed_password) {  // Gantilah dengan password_verify (biasanya password menggunakan metode enkripsi)
                // Password benar, atur sesi dan alihkan ke halaman home
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
                header("location: home.php");
            } else {
                // Tampilkan pesan error jika password tidak sesuai
                $password_err = "Password yang Anda masukkan salah.";
            }
        }
    } else {
        // Tampilkan pesan error jika username tidak ditemukan
        $username_err = "Tidak ada akun dengan username tersebut.";
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();

    // Penjelasan Kode:
    // * Session Start: Memulai sesi PHP untuk mengelola login.
    // * Prepared Statements: Menggunakan prepared statements untuk menghindari SQL injection.
    // * Pengecekan Username dan Password: Menyocokkan username dan password yang dimasukkan dengan yang ada di database.
    // * Pengalihan: Jika login sukses, pengguna akan diarahkan ke home.php.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>

</html>