<?php
session_start();
include 'koneksi.php';
include 'csrf.php';

$id = stripslashes(strip_tags(htmlspecialchars($_POST['id'] ,ENT_QUOTES)));
$nama = stripslashes(strip_tags(htmlspecialchars($_POST['nama'] ,ENT_QUOTES)));
$no_hp = stripslashes(strip_tags(htmlspecialchars($_POST['no_hp'] ,ENT_QUOTES)));
$alamat = stripslashes(strip_tags(htmlspecialchars($_POST['alamat'] ,ENT_QUOTES)));
$tgl_pengerjaan = stripslashes(strip_tags(htmlspecialchars($_POST['tgl_pengerjaan'] ,ENT_QUOTES)));
$pesanan = stripslashes(strip_tags(htmlspecialchars($_POST['pesanan'] ,ENT_QUOTES)));
$total_biaya = stripslashes(strip_tags(htmlspecialchars($_POST['total_biaya'] ,ENT_QUOTES)));

if ($id == "") {
	$query = "INSERT into transaksi (nama, no_hp, alamat, tgl_pengerjaan, pesanan, total_biaya) VALUES (?, ?, ?, ?, ?,?)";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param("sisssi", $nama, $no_hp, $alamat, $tgl_pengerjaan, $pesanan, $total_biaya);
	$dewan1->execute();
} else {
	$query = "UPDATE transaksi SET nama=?, no_hp=?, alamat=?, tgl_pengerjaan=?, pesanan=?, total_biaya=? WHERE id=?";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param("sssssi", $nama, $alamat, $tgl_pengerjaan, $no_hp, $pesanan, $total_biaya, $id);
	$dewan1->execute();
}

echo json_encode(['success' => 'Sukses']);

$db1->close();
?>