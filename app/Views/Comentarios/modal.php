<!-- Modal -->
<div class="modal-novo-comentario">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicione um Comentário</h1> -->
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
				<p class="m-0 username">
					<strong><?php echo $_SESSION["sessao_usuario"]->nome_completo; ?></strong>
				</p>
				<i class="fas fa-times" id="btn-fechar-comentario-modal"></i>
			</div>
			<div class="modal-body">
				<form id="frm-novo-comentario">
					<input type="hidden" name="comentario-id_produto" id="comentario-id_produto" value="<?php echo $_GET["id"] ?>" readonly>
					<input type="hidden" name="comentario-id_usuario" id="comentario-id_usuario" value="<?php echo $_SESSION["sessao_usuario"]->id; ?>" readonly>
					<span class="c-input">
						<!-- <p class="" for="produto-preco">Descrição</p> -->
						<div class="w-100">
							<textarea name="comentario-conteudo" id="comentario-conteudo" cols="70" rows="5" placeholder="Adicionar seu comentário aqui."></textarea>
						</div>
					</span>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="c-btn c-btn__secondary" id="btn-novo-comentario__confirmar" onclick="">Adicionar</button>
			</div>
		</div>
	</div>
</div>