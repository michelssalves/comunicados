<?php
session_start();
$tela = 'listarComunicados';
include 'includes/Handlers/index.php';
include 'Model/Comunicados.php';
include 'Controller/ComunicadosController.php';
include 'includes/menu-cliente.php';
?>
<script>
    function visualizarComunicado(idNoticia, id) {
        const url = `verComunicado.php?idNoticia=${idNoticia}&id=${id}`
        const windowFeatures = 'width=1024,height=820'
        const title = 'Visualizar'
        const newWindow = window.open(url, title, windowFeatures);

    }
</script>
<?php if (in_array($usuario['id'], $objeto->selectUserAcesso())) { ?>
<form method="POST">
    <div class="card-filtro">
        <div class="card-content-filtro">
            <button class="btn btn-success btn-sm" type="button"
                onclick="location.href='criarGrupos.php';">Grupos</button>
            <button type="button" class="btn btn-info btn-sm"
                onclick="location.href='criarComunicado.php';">Criar</button>
        </div>
    </div>
</form>
<?php } ?>
<div class="row">
    <div class="col">
    </div>
    <div class="col-8">
        <div class="card-table">
            <div class="table-responsive-md">
                <table class="table table-sm table-bordered table-striped table-hover sortable">
                    <thead>
                        <tr>
                            <th>ASSUNTO DO COMUNICADO</th>
                            <th colspan="2" id="data-noticia">DATA</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?= $listarNoticias ?>
                    <tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
    </div>
</div>
</body>

</html>
<script>
    window.onload = function () {
        document.getElementById("data-noticia").click();
        document.getElementById("data-noticia").click();
    }   
</script>
<div class="modal fade" id="modalCriarGrupo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Anexar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="visualizarRequisicao.php?id=<?= $row['id_requisicao'] ?>" enctype="multipart/form-data"
                    method="POST">
                    <input type="hidden" name="action" value="gravarAnexo">
                    <div class="form-group">
                        <label for="numDoc">Descrição do Documento</label>
                        <input type="text" name="numDoc" id="numDoc" class="form-control"
                            placeholder="DESCRIÇÃO DO DOCUMENTO">
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Grupo
                                </a>
                                <div style="width: 350px;padding-left: 20px;" class="dropdown-menu"
                                    aria-labelledby="dropdownMenuLink">
                                    <ul>
                                        <?= $objeto->menuSelectEmails(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</div>
</div>