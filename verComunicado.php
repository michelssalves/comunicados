<?php
session_start();
$tela = 'visualizarComunicado';
$menuOff = true;
include 'includes/Handlers/index.php';
include 'Model/Comunicados.php';
include 'Controller/ComunicadosController.php';
include 'includes/menu-cliente.php';
?>
<body>
    <div class="row">
        <div class="col-12">
            <div class="card-table">
                <img style="width: 30px;height: 30px;border-radius: 45%;" src="./assets/img/fotos-perfil/logoRdp.png" />
                <span class="fidi-date">Publicado em <?= $objeto->dma($row['data_noticia']) ?></span>
                <hr>
                <a href=""><img src='./assets/img/imagens/<?= $row['imagem_inicio'] ?>' class='rounded-top col-md-8 d-flex mx-auto'></a>
            </div>
        </div>
    </div>
</body>
</html>