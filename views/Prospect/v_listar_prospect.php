<?php
session_start();
require_once('../../models/Usuario.php');
require_once('../../controllers/Prospect/ControllerProspect.php');

use controller\ControllerProspect;
use models\Usuario;

if(isset($_SESSION['usuario'])){
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bem Vindo ao Sistema</title>
        <link rel="stylesheet" type="text/css" href="../../libs/bootstrap/css/bootstrap.css">
        <style type="text/css">
            .table-overflow {
                max-height:600px;
                overflow-y:auto;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="collapse navbar-collapse" id="textoNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link " href="../principal.php">Home <span class="sr-only">(Página atual)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cadastrar Prospects</a>
                        </li>
                    </ul>
                   <span class="navbar-text">
                    Bem vindo: <?php $usuario = unserialize($_SESSION['usuario']);
                    echo $usuario->nome;
                    ?>
                </span>

                </div>
            </nav>
        </header><br>
        <div class="container">
            <div class="table-overflow" style= "height: 750; overflow: auto;">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Facebook</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           $ctrlProspect = new ControllerProspect();
                           $listarProspects = $ctrlProspect->buscarProspects();
                           foreach($listarProspects  as $prospect){
                              echo '<tr>';
                                 echo '<td>'.$prospect->nome.'</td>';
                                 echo '<td>'.$prospect->email.'</td>';
                                 echo '<td>'.$prospect->celular.'</td>';
                                 echo '<td>'.$prospect->facebook.'</td>';
                                 echo '<td>'.$prospect->whatsapp.'</td>';
                                 echo '<td width="150"><a href="v_alterar_prospect.php?email='.$prospect->email.'">alterar</a> |
                                       <a href="../../controllers/Prospect/c_excluir_prospect.php?codigo='.$prospect->codigo.'">excluir</a></td>' ;
                              echo '</tr>';
                           }
                        ?>
                    </tbody>
                </table>
            </div>
            <div>
                <a class="btn btn-primary" href="v_incluir_prospect.php">Novo</a>
            </div>
        </div>

    </body>
</html>
<?php
}else{
   $_SESSION['erroLogin'] = "Faça o Login para acessar o sistema!";
   header("Location: ../../index.php");
}
?>
