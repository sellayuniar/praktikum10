<?php
include('koneksi.php'); //memasukan file koneksi.php
$query = mysqli_query($koneksi,"select * from tb_covid"); //query untuk mengambil data di tabel tb_covid
while($row = mysqli_fetch_array($query)){//perulangan untuk menyimpan data 
	$negara[] = $row['negara']; //membuat array
	$total_kasus[] = $row['total_kasus']; //membuat array
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
					label: 'Kasus Covid-19',
					data: <?php echo json_encode($total_kasus); ?>, //data bar
					backgroundColor: 'rgba(255, 99, 132, 0.2)', //warna
					borderColor: 'rgba(255,99,132,1)', //warna
					borderWidth: 1 //tebal border
				
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
 