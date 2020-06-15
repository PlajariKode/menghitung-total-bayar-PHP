<?php 

// koneksi
$conn = new mysqli('localhost', 'root', '', 'test');

// simpan data
if (isset($_POST['submit'])) {
	$nb = $_POST['nama_barang'];
	$hrg = $_POST['harga'];
	$qty = $_POST['qty'];

	$q = mysqli_query($conn, "INSERT INTO produk (nama_barang, harga, qty) VALUES ('$nb', '$hrg', '$qty')");

	if($q) {
		header('Location: index.php');
	} else {
		echo "<script>alert('Gagal menambahkan data'); window.location.href = index.php;</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Menghitung total bayar</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	
	<div class="container mt-5 mx-auto">
		<center>
			<h1>Menghitung total bayar dengan PHP</h1>
		</center>

		<div class="card mt-5">
			<div class="card-body mx-auto">
				<form method="POST" action="" class="form-inline mt-3">
					<label for="nama_barang">Nama Barang&nbsp;</label>
					<input type="text" name="nama_barang" id="nama_barang" class="form-control mr-sm-2">
					<label for="harga">Harga&nbsp;</label>
					<input type="number" name="harga" id="harga" class="form-control mr-sm-2">
					<label>Qty&nbsp;</label>
					<input type="number" name="qty" id="qty" class="form-control mr-sm-2">
					<button type="submit" name="submit" class="btn btn-primary">Hitung</button>
				</form>

				<table class="table table-bordered mt-5">
					<tr>
						<th>#</th>
						<th>Nama Barang</th>
						<th>Harga Satuan</th>
						<th>Qty</th>
						<th>Total</th>
					</tr>

					<?php
					// perintah tampil data
					$q = mysqli_query($conn, "SELECT * FROM produk");
					
					$total = 0;
					$tot_bayar = 0;
					$no = 1;

					while ($r = $q->fetch_assoc()) {
						// total adalah hasil dari harga x qty
						$total = $r['harga'] * $r['qty'];
						// total bayar adalah penjumlahan dari keseluruhan total
						$tot_bayar += $total;
					?>

					<tr>
						<td><?= $no++ ?></td>
						<td><?= ucwords($r['nama_barang']) ?></td>
						<td><?= $r['harga'] ?></td>
						<td><?= $r['qty'] ?></td>
						<td><?= $total ?></td>
					</tr>

					<?php			
					}
					?>

					<tr>
						<th colspan="4">Total Bayar</th>
						<th><?= $tot_bayar ?></th>
					</tr>

				</table>
			</div>
		</div>
	</div>

</body>
</html>