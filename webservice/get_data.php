<?php
session_start();
include 'koneksi.php';
include 'csrf.php';

$id = $_POST['id'];
$query = "SELECT * FROM transaksi WHERE id=? ORDER BY id DESC";
$dewan1 = $db1->prepare($query);
$dewan1->bind_param('i', $id);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
    $h['id'] = $row["id"];
    $h['nama'] = $row["nama"];
    $h['no_hp'] = $row["no_hp"];
    $h['alamat'] = $row["alamat"];
    $h['tgl_pengerjaan'] = $row["tgl_pengerjaan"];
    $h['pesanan'] = $row["pesanan"];
     $h['total_biaya'] = $row["total_biaya"];
}
echo json_encode($h);

$db1->close();
?>