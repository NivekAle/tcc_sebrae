<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/dashboard.css">
	<title>Dashboard</title>
</head>

<body>

	<main>

		<div class="dashboard">
			<div class="row m-0">
				<div class="col-lg-2">
					<aside class="sidebar">
						dasd
					</aside>
				</div>
				<div class="col-lg-10">
					<div class="row">
						<!-- ! Navbar -->
						<div class="col-lg-12">
							<div class="navbar bg-light">
								<h4 class="navbar__name">
									Bem vindo, nome do vendedor
								</h4>
							</div>
						</div>
						<!-- Conteudo -->
						<div class="dashboard__content">
							<div class="row">
								<div class="col-lg-12">
									<div class="dashboard__total" style="width:400px !important;">
										<canvas id="myChart" width="20" height="20"></canvas>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<div class="box">
										<div class="box__content">
											<small class="box__title">Vendas</small>
											<h5 class="box__output">
												1.4534
											</h5>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="box">
										<div class="box__content">
											<small class="box__title">Concluidas</small>
											<h5 class="box__output">
												42.529
											</h5>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="box">
										<div class="box__content">
											<small class="box__title">Anuladas</small>
											<h5 class="box__output">
												2.134
											</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?php require_once("../partials/assets.php"); ?>
	<script src="http://localhost/tcc/public/js/dashboard.js"></script>
	<script>
		// Chart.defaults.global.legend.display = false;
		const ctx = document.getElementById('myChart').getContext('2d');
		const myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
				datasets: [{
					label: '# of Votes',
					data: [12, 19, 3, 5, 2, 3],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				},
				plugins: {
					legend: {
						display: false,
					}
				}
			}
		});
	</script>
</body>

</html>