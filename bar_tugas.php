<?php
include('koneksi.php'); //memasukan file koneksi.php
$query = mysqli_query($koneksi,"select * from tb_covid"); //query untuk mengambil data di tabel tb_covid
while($row = mysqli_fetch_array($query)){//perulangan untuk menyimpan data 
	$negara[] = $row['negara']; //membuat array
	$total_kasus[] = $row['total_kasus']; //membuat array
	$kasus_baru[] = $row['kasus_baru'];
	$total_kematian[] = $row['total_kematian'];
	$kematian_baru[] = $row['kematian_baru'];
	$total_sembuh[] = $row['total_sembuh'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar Chart Menggunakan Chartjs</title>
	<script type="text/javascript" src="Chart.js"></script>  <!--memanggil file chart.js -->
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas> <!--membuat objek -->
	</div>
 
 
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, { //membuat chart type bar
			type: 'bar',
			data: {
				labels: <?php echo json_encode($negara); ?>, //label chart
				datasets: [{
					label: 'total kasus',
					data: <?php echo json_encode($total_kasus); ?>, //data bar
					backgroundColor: 'rgba(252, 99, 132, 0.2)', //warna
					borderColor: 'rgba(211,99,132,1)', //warna
					borderWidth: 1 //tebal border
				
				},

					{
					label: 'kasus baru',
					data: <?php echo json_encode($kasus_baru); ?>, //data bar
					backgroundColor: 'rgba(255, 99, 132, 0.7)', //warna
					borderColor: 'rgba(255,19,152,7)', //warna
					borderWidth: 1 //tebal border
				
				},

					{
					label: 'Total Kematian',
					data: <?php echo json_encode($total_kematian); ?>, //data bar
					backgroundColor: 'rgba(275, 69, 192, 1)', //warna
					borderColor: 'rgba(295,19,132,1)', //warna
					borderWidth: 1 //tebal border
				
				},

					{
					label: 'kematian baru',
					data: <?php echo json_encode($kematian_baru); ?>, //data bar
					backgroundColor: 'rgba(255, 49, 14, 11)', //warna
					borderColor: 'rgba(255,99,132,1)', //warna
					borderWidth: 1 //tebal border
				
				},

					{
					label: 'Total sembuh',
					data: <?php echo json_encode($total_sembuh); ?>, //data bar
					backgroundColor: 'rgba(115, 91, 112, 2)', //warna
					borderColor: 'rgba(255,99,132,1)', //warna
					borderWidth: 1 //tebal border
				
				}


				]
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
 