<?php
session_start();
$tela = 'criarGrupo';
$menuOff = true;
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
                <form method="POST">
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
                    <div class="form-group">
                        <input type="text" name="numDoc" id="numDoc" class="form-control" placeholder="NOME DO GRUPO">
                    </div>
                    <div class="form-group">
                    <button class="btn btn-success" type="submit" name="action" value="criarGrupo">CRIAR</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-3">
        </div>
    </div>
</body>
</html>