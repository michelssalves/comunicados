<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Cores Do Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row flex-wrap">
                        <div class="col-md-4 col-sm-6">
                            <label for="validationTooltip04">MENU</label>
                            <input type="hidden" name="action" value="atualizarCores">
                            <input type="hidden" name="idMenu" value="<?=$idMenu?>">
                            <input type="hidden" name="idUsuario" value="<?=$usuario['id']?>">
                            <select name="idCampo" required class="form-control form-control-sm" name="menu">
                                <option selected value="">ESCOLHA</option>
                                    <?=$cbCampos?>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="validationTooltip04">COR</label>
                            <select name="idCor" class="form-control form-control-sm" name="cor1">
                                <option selected value="">ESCOLHA</option>
                                <?= $cbCores?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            </form>
        </div>
    </div>
</div>