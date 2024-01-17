<?php
include $_SERVER['DOCUMENT_ROOT'] . '/routes/routes.php';
include 'assets/class/conexao.php';
include 'assets/class/acessoBD.class.php';
include 'assets/class/menuHeader.php'; 
if($id_u == '10' || $id_u == '161' || $id_u == '84' || $id_u == '92' || $id_u == '392'|| $id_u == '211' || $id_u == '2053' || $id_u == '202'){
?>
<body>
    <section class="container main">
        <section class="feed mt-10">
            <table class="w3-table w3-table-all" border="1">
                <thead>
                    <form method="POST">
                        <tr>
                            <th>
                                <select required id="email" name="email[]" multiple>
                                    <?php
                                    $sql = "SELECT * FROM ti_clientes ORDER BY email";
                                    $qry = odbc_exec($connP, $sql);
                                    while ($row = odbc_fetch_array($qry)) {
                                        echo '<option value="'.$row['id'].'">'.$row['email'].'</option>';
                                    }
                                    ?>
                                </select>
                            </th>
                            <th>
                               
                                <select required id="grupos" name="grupo[]" multiple>
                                    <?php
                                    $sql = "SELECT DISTINCT(IL.id), IL.descricao FROM inventario_local AS IL
                                        JOIN noticias_grupos AS NG
                                        ON IL.id = NG.id_grupo
                                        WHERE grupo_status > 0
                                        ORDER BY descricao";
                                    $qry = odbc_exec($connP, $sql);
                                    while ($row = odbc_fetch_array($qry)) {
                                        echo '<option value="'.$row['id'] .'">'.$row['descricao'].'</option>';
                                    }
                                    ?>
                                </select>
                            </th>
                            <th colspan="2">
                                <button class="w3-button w3-green" type="submit" name="acao" value="incluir-no-grupo">INCLUIR</button>
                            </th>
                    </form>
        </section>
    </section>
    <table id="example" class="w3-table w3-table-all sortable" border="1">
        <thead class="sorttable">
            <tr>
                <th><center>Email</center></th>
                <th><center>Grupo</center></th>
                <th><center>Ação</center></th>
            </tr>
       </thead>  
       <tbody>
             <?= listarGrupos($baseAvisos) ?>                              
       </tbody>
    </table>   
<!-- MULTISELECT -->
<script src="./assets/js/multiselect.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="./assets/js/vanillaModal.js"></script>
<script src="./assets/js/filtroTabela1.js"></script>
<script src="./assets/js/filtroTabela2.js"></script>
<!-- MULTISELECT -->
</body>
</html>
<?php }else{
     header("Location: https://intranet.rdpenergia.com.br/comunicados/");
}