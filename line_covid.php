<?php
include('koneksi.php'); //memasukan file koneksi.php
$query = mysqli_query($koneksi,"select * from tb_covid"); //query untuk mengambil data di tabel tb_covid
while($row = mysqli_fetch_array($query)){ //perulangan
	$negara[] = $row['negara'];  //membuat array
	$total_kasus = $row['total_kasus'];  //membuat array
	$kasus_baru[] = $row['kasus_baru'];  //membuat array
	$total_kematian[] = $row['total_kematian'];  //membuat array
	$kematian_baru[] = $row['kematian_baru'];  //membuat array
	$total_sembuh[] = $row['total_sembuh'];  //membuat array
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Line Chart 10 Negara</title>
	<script type="text/javascript" src="Chart.js"></script> <!--memanggil file chart.js -->
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas> <!--membuat objek -->
	</div>

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line', //membuat chart type line
			data: {
				labels: <?php echo json_encode($negara); ?>,
				datasets: [ //isi chart
				{
					label: 'Total Kasus',
					
					fill: false, 
					data: <?php echo json_encode($total_kasus); ?>,
					backgroundColor: 'rgba(171, 54, 35, 1)', 
					borderColor: 'rgba(255,99,132,1)', 
					borderWidth: 1
				},
				{
					label: 'Kasus Baru',
					
					fill: false, 
					data: <?php echo json_encode($kasus_baru); ?>,
					backgroundColor: 'rgba(235, 99, 132, 1)', 
					borderColor: 'rgba(255,91,132,1)', 
					borderWidth: 1
				},
				{
					label: 'Total kematian',
					fill: false,
					data: <?php echo json_encode($total_kematian); ?>,
					backgroundColor: 'rgba(65, 135, 245, 1)',
					borderColor: 'rgba(66, 155, 245,1)',
					borderWidth: 1
				},
				{
					label: 'Kematian Baru',
					fill: false,
					data: <?php echo json_encode($kematian_baru); ?>,
					backgroundColor: 'rgba(249, 152, 35, 1)',
					borderColor: 'rgba(247, 132, 35,1)',
					borderWidth: 1
				},
				{
					label: 'Total Sembuh',
					fill: false,
					data: <?php echo json_encode($total_sembuh); ?>,
					backgroundColor: 'rgba(133, 295, 29, 1)',
					borderColor: 'rgba(133, 245, 89,1)',
					borderWidth: 1
				},
				
				]
			},
			options: {//mengatur garis
			
				elements: {
			        line: {
			            tension: 0
			        }
			    },
				legend: {
					display: true
				},
				barValueSpacing: 20,
				scales: {
					yAxes: [{
						ticks: {
						
							min: 0,
						}
					}],
					xAxes: [{
						gridLines: {
							
							color: "rgba(0, 0, 0, 0)",
						}
					}]
				}
			}
		});
	</script>
</body>
</html>