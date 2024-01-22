<?php
session_start();
$tela = 'criarComunicado';
include 'includes/Handlers/index.php';
include 'Model/Comunicados.php';
include 'Controller/ComunicadosController.php';
include 'includes/menu-cliente.php';
?>
<body>
	<div class="row">
		<div class="col-3">
		</div>
		<div class="col-6">
			<div class="card-table">
				<form enctype="multipart/form-data" method="POST" id="form">
					<div class="input-group mb-3">
						<div class="dropdown">
							<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Grupo
							</a>
							<div style="width: 350px;padding-left: 20px;" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<ul>
									<?= $objeto->menuSelectGrupos(); ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="text" name="titulo" class="form-control" placeholder="Título do Comunicado">
					</div>
					<div class="input-group mb-3">
						<input type="text" name="fonte" class="form-control" placeholder="Link da Imagem">
					</div>
					<div class="input-group mb-3">
						<input type="text" name="redirecionamento" class="form-control" placeholder="Redirecionamento">
					</div>
					<textarea hidden name="noticia" id="textarea"></textarea>
					<div style="height: 250px;" id="editor"></div>
					<div class="input-group mb-3">
						<input type="file" class="form-control-file" name="arquivo">
					</div>
					<div class="input-group mb-3">
						<button id="botaoForm" name="action" value="criarComunicado" class="btn btn-success">Salvar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-3">
	</div>
	</div>
	<script src="/scripts/js/quillformatar.js"></script>
</body>
</html>
