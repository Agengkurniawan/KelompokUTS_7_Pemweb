<?php
function generate_produk()
{
	include "../config/koneksi.php";

	$sql = "SELECT max(produk_kode) FROM tb_produk";
	$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	$kode_faktur = mysqli_fetch_array($query);

	if ($kode_faktur) {
		$nilai = substr($kode_faktur[0], 5);
		$kode = (int) $nilai;

		//tambahkan sebanyak + 1
		$kode = $kode + 1;
		$auto_kode = "PRO-" . str_pad($kode, 6, "0",  STR_PAD_LEFT);
	} else {
		$auto_kode = "PRO-000001";
	}
	return $auto_kode;
}

function generate_order()
{
	include "../config/koneksi.php";

	$sql = "SELECT max(order_kode) FROM tb_order";
	$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	$kode_faktur = mysqli_fetch_array($query);

	if ($kode_faktur) {
		$nilai = substr($kode_faktur[0], 5);
		$kode = (int) $nilai;

		//tambahkan sebanyak + 1
		$kode = $kode + 1;
		$auto_kode = "ORD-" . str_pad($kode, 6, "0",  STR_PAD_LEFT);
	} else {
		$auto_kode = "ORD-000001";
	}
	return $auto_kode;
}
?>