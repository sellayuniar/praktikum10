<?php
include('koneksi.php'); //memasukan file koneksi.php
$label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"]; //membuat varibel $label untuk meyimpan nama bulan dalam array

for($bulan = 1;$bulan < 13;$bulan++)//perulangan 
{
	$query = mysqli_query($koneksi,"select sum(jumlah) as jumlah from tb_penjualan where MONTH(tgl_penjualan)='$bulan'"); //query untuk menampilkan data
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
		var myChart = new Chart(ctx, {//membuat chart baru tipe bar
			type: 'bar',
			data: {
				labels: <?php echo json_encode($label); ?>, //label 
				datasets: [{
					label: 'Grafik Penjualan',
					data: <?php echo json_encode($jumlah_produk); ?>,//isi grafik bar
					borderWidth: 1
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