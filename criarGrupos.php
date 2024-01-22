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
  <form method="POST">
    <div class="row mt-1">
      <div class="col">
      </div>
      <div class="col-8">
        <div class="card-table">
          <h3>Criar Grupo</h3>
          <hr>
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="dropdown">
                <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Emails
                </a>
                <div style="width: 400px; max-height: 300px; overflow-y: auto;" class="dropdown-menu"
                  aria-labelledby="dropdownMenuLink">
                  <input style="margin-left: 10px;width: 350px;" type="text" id="searchInput0"
                    class="form-control mb-2 w-2" onkeyup="filterDropdown(0)" placeholder="Buscar...">
                  <ul style="padding-left: 20px;" id="dropdownList0">
                    <?= $objeto->menuSelectEmails(); ?>
                  </ul>
                </div>
              </div>
              <input type="text" name="nomeDoGrupo" id="nomeDoGrupo" class="form-control ml-2" placeholder="NOME DO GRUPO">
              <button class="btn btn-success ml-2" type="submit" name="action" value="criarGrupo">Salvar</button>
              <button class="btn btn-info ml-2" type="button" onclick="location.href='index.php';">Voltar</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
      </div>
    </div>
  </form>
  <form method="POST">
    <div class="row mt-1">
      <div class="col">
      </div>
      <div class="col-8">
        <div class="card-table">
          <h3>Incluir Email No Grupo</h3>
          <hr>
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="dropdown">
                <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Emails
                </a>
                <div style="width: 400px; max-height: 300px; overflow-y: auto;" class="dropdown-menu"
                  aria-labelledby="dropdownMenuLink">
                  <input style="margin-left: 10px;width: 350px;" type="text" id="searchInput1"
                    class="form-control mb-2 w-2" onkeyup="filterDropdown(1)" placeholder="Buscar...">
                  <ul style="padding-left: 20px;" id="dropdownList1">
                    <?= $objeto->menuSelectEmails(); ?>
                  </ul>
                </div>
              </div>
              <div class="dropdown  ml-2">
                <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Grupos
                </a>
                <div style="width: 400px; max-height: 300px; overflow-y: auto;" class="dropdown-menu"
                  aria-labelledby="dropdownMenuLink">
                  <input style="margin-left: 10px;width: 350px;" type="text" id="searchInput2"
                    class="form-control mb-2 w-2" onkeyup="filterDropdown(2)" placeholder="Buscar...">
                  <ul style="padding-left: 20px;" id="dropdownList2">
                    <?= $objeto->menuSelectGrupos(); ?>
                  </ul>
                </div>
              </div>
              <button class="btn btn-success ml-2" type="submit" name="action" value="incluirNoGrupo">Salvar</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
      </div>
    </div>
  </form>
  <div class="row mt-1">
    <div class="col">
    </div>
    <div class="col-8">
      <div class="card-table">
        <h3>Grupos</h3>
        <hr>
        <table id="example" class="w3-table w3-table-all sortable" border="1">
          <thead class="sorttable">
            <tr>
              <th>
                <center>Email</center>
              </th>
              <th>
                <center>Grupo</center>
              </th>
              <th>
                <center>Ação</center>
              </th>
            </tr>
          </thead>
          <tbody>
            <?= $txtTable ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col">
    </div>
  </div>
  <script src="./assets/js/filtroTabela1.js"></script>
  <script src="./assets/js/filtroTabela2.js"></script>
  <script>
    function filterDropdown(x) {
      let drop = `dropdownList${x}`
      let search = `searchInput${x}`
      let input, filter, ul, li, a, i
      input = document.getElementById(search)
      filter = input.value.toUpperCase();
      ul = document.getElementById(drop)
      li = ul.getElementsByTagName("li")

      for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("span")[0]
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
          li[i].style.display = ""
        } else {
          li[i].style.display = "none"
        }
      }
    }
  </script>
</body>

</html>