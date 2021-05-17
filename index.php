<?php
include('koneksi.php');//memasukan file koneksi.php
$produk = mysqli_query($koneksi,"select * from tb_barang"); //query untuk mengambil data di tabel tb_barang
while($row = mysqli_fetch_array($produk)){ //perulangan untuk menyimpan data 
	$nama_produk[] = $row['barang']; //membuat array
	
	$query = mysqli_query($koneksi,"select sum(jumlah) as jumlah from tb_penjualan where id_barang='".$row['id_barang']."'"); //query untuk menjumlahkan 
	$row = $query->fetch_array(); //untuk menyimpan hasil query
	$jumlah_produk[] = $row['jumlah']; //untuk menyimpan data
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Membuat Grafik Menggunakan Chart JS</title>
	<script type="text/javascript" src="Chart.js"></script> <!--memanggil file chart.js -->
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas> <!--membuat objek -->
	</div>


	<script>
		var ctx = document.getElementById("myChart").getContext('2d'); 
		var myChart = new Chart(ctx, { //membuat chart baru tipe bar
			type: 'bar',
			data: {
				labels: <?php echo json_encode($nama_produk); ?>, //label chart nama produk
				datasets: [{
					label: 'Grafik Penjualan',
					data: <?php echo json_encode($jumlah_produk); ?>, //data chart jumlah produk
					backgroundColor: 'rgba(255, 99, 132, 0.2)', //warna
					borderColor: 'rgba(255,99,132,1)', //warna
					borderWidth: 1 //besar border
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>