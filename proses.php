<?php
require 'db.php';

$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$telepon = trim($_POST['telepon'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$pengalaman = trim($_POST['pengalaman'] ?? '');
$pendidikan = trim($_POST['pendidikan'] ?? '');

if ($nama === '' || $email === '' || $telepon === '' || $alamat === '' || $pengalaman === '' || $pendidikan === '') {
    $message = 'Mohon isi semua kolom sebelum mengirimkan formulir.';
    header('Location: index.html?status=error&message=' . urlencode($message));
    exit;
}

$stmt = $conn->prepare("INSERT INTO pelamar (nama, email, telepon, alamat, pengalaman, pendidikan) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('ssssss', $nama, $email, $telepon, $alamat, $pengalaman, $pendidikan);

if ($stmt->execute()) {
    $message = "Terima kasih, $nama. Lamaran Anda berhasil diterima dan disimpan ke database.";
    header('Location: index.html?status=success&message=' . urlencode($message));
    exit;
} else {
    $message = 'Maaf, terjadi kesalahan saat menyimpan data: ' . $stmt->error;
    header('Location: index.html?status=error&message=' . urlencode($message));
    exit;
}
