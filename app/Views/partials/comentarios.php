<!-- <php foreach ($comentarios as $key => $value) { ?>
	<div class="comentario-card">
		<div class="comentario-card__header">
			<span>
				<h6 class="comentario-card__title">
					<php echo $value["nome_completo"] ?>
				</h6>
				<p class="comentario-card__created">
					<php
					$timestamp = $value["criado_em"];
					$date = substr($timestamp, 0, 11);
					$date = date("d/m/Y");
					echo $date;
					?>
				</p>
			</span>
			<div class="comentarios-card__likes">
				<i class="fas fa-star"></i>
				<i class="fas fa-star-half-alt"></i>
				<i class="far fa-star"></i>
				<php echo $produto->likes; ?>
			</div>
		</div>
		<div class="comentario-card__body">
			<php echo $value["conteudo"] ?>
		</div>
	</div>
<php } ?> -->