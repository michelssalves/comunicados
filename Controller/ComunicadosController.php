<?php
$objeto = new Comunicados();
$action = $_REQUEST['action'];
$usuario = $objeto->selectUserById($_SESSION['id_u']);
if (!$usuario) { header('Location:https://intranet.rdpenergia.com.br/');}

if ($usuario['nomeCompleto'] && $tela == 'listarComunicados') {

    if($action == 'excluirNoticia'){

        $noticia = $_REQUEST['noticia'];

        echo $objeto->deleteNoticia($noticia);

        header("Location: index.php");

    }

    foreach($objeto->getNoticiasByGrupo($objeto->getGrupos($usuario), $usuario) as $row){

            $cor[1] = '';
            $cor[0] = 'style="font-weight: bold;"';   

            $link = "onClick='visualizarComunicado(".$row['id_noticia'].",  ".$usuario['id'].")'";

            $listarNoticias .= '<tr '.$cor[$row['lido']].' >
                <td '.$link.'>'.$row['titulo'].'</a></td>
                <td>'.$objeto->dma($row['data_noticia']).'</td>';  
        if($usuario['id']  == '161' || $usuario['id']  == '238'|| $usuario['id']  == '392' || $usuario['id']  == '211' || $usuario['id']  == '92'){
            $listarNoticias .= '
                <td><center><a href="?noticia='.$row['id_noticia'].'&action=excluirNoticia"><img class="iconetrash" src="./includes/img/icones/trash.png"></a></td>
                </tr>';
        } 
    }
}
if ($usuario['nomeCompleto'] && $tela == 'visualizarComunicado') {

    $idNoticia = $_REQUEST['idNoticia'];
    $idUsuario = $usuario['id'];

    $row = $objeto->getNoticiasById($idNoticia);

    $idGrupo = $row['id_grupo'];

     if($objeto->getNoticiasLidas($idNoticia, $idUsuario) == 0){

        echo $objeto->registrarVisualizacao($idUsuario, $idNoticia, $idGrupo);
     }else{
        echo "<script>console.log('Já visualizou essa noticia')</script>";
     }
}
if ($usuario['nomeCompleto'] && $tela == 'criarComunicado') {

    $idGrupos = $_REQUEST["grupos"];
    
    if($idGrupos != ''){

        if (($_FILES["arquivo"]["name"] <> "")) {

            $nomeArquivo = $objeto->getUltimoId('noticias_rdp', 'id_noticia');
            $objeto->anexarArquivos($_FILES['arquivo']['tmp_name'], $nomeArquivo, $_FILES['arquivo'], 'includes/img/imagens/');

        } else {

            $nomeArquivo = 'default.png';
        }

        $tam = count($idGrupos);
      
        for($x=0; $x<$tam; $x++){

          echo $objeto->insertComunicado($_REQUEST,$idGrupos[$x],$usuario['nomeCompleto'],$nomeArquivo); 
               $idNoticia = $objeto->getUltimoId('noticias_rdp', 'id_noticia');   
          echo $objeto->insertNoticiaLigacao($idGrupos[$x], $idNoticia);

        }
    } else{

        echo "<script>alert('Não foi selecionado um grupo!!')</script>";
    }
}
if ($usuario['nomeCompleto'] && $tela == 'criarGrupo') {

    if($action == 'criarGrupo'){
      
    $objeto->insertNoticiaLigacao(strtoupper($_REQUEST['nomeDoGrupo']));

    $ultimoId = $objeto->getUltimoId('inventario_local','id');
                        
            if (isset($_REQUEST['emails'])) {

              foreach ($_REQUEST['emails'] as $item) {
      
                  $sql1 .= '('.$item .','.$ultimoId.', 1),';
              }
              
              $tam = strlen($sql1);
              $sql1 = substr($sql1, 0, $tam - 1);
              $sql1 = ("INSERT INTO noticias_grupos (id_usuario, id_grupo, grupo_status) VALUES $sql1");
              odbc_exec($objeto->connP(), $sql1);
            }
    }
    if($action == 'incluirNoGrupo'){

        $idUsuario = $_REQUEST["emails"];
        $grupo = $_REQUEST["grupos"];

        $tamId = count($idUsuario);
        $tamGrupo = count($grupo);

        for($x=0; $x<$tamGrupo; $x++){
    
            for($y=0; $y<$tamId; $y++){
                
                $objeto->incluirNoGrupo($idUsuario[$y], $grupo[$x]);

            }
        }
        
    }
    if($action == 'excluirDoGrupo'){

        $objeto->excluirDoGrupo($_REQUEST);
        header("Location: criarGrupos.php");

    }

    $qry = $objeto->listarGrupos();
    foreach($qry as $row){
            $txtTable .= '<tr>
            <th><center>'.$row['email'] .'</th>
            <th><center>'.$row['descricao'] .'</th>
            <th><center><a href="?id='.$row['id_grp'].'&action=excluirDoGrupo"><img class="iconetrash" src="./includes/img/icones/trash.png"></a></th>
            </tr>';
    }
}