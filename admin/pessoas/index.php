<?php
include_once('../includes/topo.php');
//trazer dados do banco de dados
//
mysql_query("SET NAMES utf8");
$sql = "SELECT * from `pessoas` ";
$resultado = mysql_query($sql);

if(!isset($_POST['submit'])){

    if(@$_GET['sucesso'] == 'sim' )
    {
        echo "<script>
                $(document).ready(function() {
                    $('.sucesso').html('Modificações realizadas com Sucesso');
                });
              </script>";
    }
?>
<script type="text/javascript">
    $(document).ready(function() {
        $("a.iframe").fancybox({
            'width'				: 840,
            'height'            : 600,
            'autoScale'			: false,
            'transitionIn'			: 'none',
            'transitionOut'			: 'none',
            'type'				: 'iframe'
        });
    });
</script>

<!-- adicionar clientes -->
<fieldset id="pessoas_fieldset">
<legend><b>Adicionar Pessoas</b></legend>
    <form enctype="multipart/form-data" class="pessoas_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
        <!-- Nome, Foto, Cargo,  Depoimento, Tipo -->
        <tr>
            <td><label for="nome">Nome: </label></td>
            <td><input type="text" name="nome" id="nome" /></td>
        </tr>

        <tr>
        <td><label for="foto_file">Foto: </label></td>
        <td><input type="file" name="foto_file" id="foto_file" /></td>
        </tr>
        <!---->
        <tr>
            <td><label for="fotocareta_file">Foto Careta: </label></td>
            <td><input type="file" name="fotocareta_file" id="fotocareta_file" /></td>
        </tr>

        <tr>
        <td><label for="cargo">Cargo: </label></td>
        <td><input type="text" name="cargo" id="cargo" /></td>
        </tr>

        <tr>
            <td><label for="depoimento">Depoimento: </label></td>
            <td><textarea name="depoimento" id="depoimento"></textarea></td>
        </tr>

        <tr>
        <td><label for="tipo">Tipo: </label></td>
        <td><select id="tipo" name="tipo">
            <option value="ex-membro">ex-membro</option>
            <option value="membro">membro</option>
        </select></td>
        </tr>

        <tr>
            <td><label for="mostrar">Mostrar: </label></td>
            <td><input type="checkbox" name="mostrar" id="mostrar" checked /></td>
        </tr>

        <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="submit" value="Inserir" /></td>
        </tr>

        </table>
    </form>
</fieldset>

<br />
<div style="color: blue;font-weight: bold;" class="sucesso"></div>
<br />

<fieldset id="pessoas_cadastrados_fieldset">
    <legend><b>Clientes e Parceiros Cadastrados</b></legend>
    <table border="1">
        <!-- logo (file), link (text), tipo (combobox), motrar (checkbox) -->
        <thead>
            <tr>
                <th>Nome</th>
                <th>Foto</th>
                <th>Foto Careta</th>
                <th>Cargo</th>
                <th>Depoimento</th>
                <th>Tipo</th>
                <th>Mostrar</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($pessoas = mysql_fetch_array($resultado))
        //for($i = 0 ; $i <2 ;$i++)
        {
              echo '<tr>
                    <td>'.$pessoas['nome'].'</td>

                    <td><img width="150px" height="40px" src="../../'.$pessoas['foto'].'"/></td>

                    <td><img width="150px" height="40px" src="../../'.$pessoas['foto_careta'].'"/></td>

                    <td>'.$pessoas['cargo'].'</td>

                    <td>'.$pessoas['depoimento'].'</td>

                    <td>';

                    echo $pessoas['tipo'];

                    echo '</td>';

                    echo '<td><input type="checkbox" disabled="disabled" name="mostrar" id="mostrar"';

              //checando se o parceiro é para ser exibido ou não
              if($pessoas["mostrar"] == true){ echo "checked"; }

              echo ' /></td>';

              echo   '<td>
                      <a class="iframe" href="AtualizarEditarPessoas.php?id='.$pessoas['id'].'">
                      <img  src="../../images/ico_editar.gif" />
                      </a>
                      </td>
                      </tr>';
        }
        ?>
        </tbody>
    </table>
</fieldset>

<?php

include_once('../includes/rodape.php');

}
else
{

    if($_POST['mostrar'] == '')
    {
        $mostrar = 0;
    }
    else
    {
        $mostrar = 1;
    }
  

    if ($_FILES["foto_file"]["error"] > 0 && $_FILES["fotocareta_file"]["error"] > 0)
    {
        echo "Return Code: " . $_FILES["foto_file"]["error"] . "<br />";
        echo "Return Code: " . $_FILES["fotocareta_file"]["error"] . "<br />";
    }
    else
    {
        echo "Upload: " . $_FILES["foto_file"]["name"] . "<br />";
        echo "Type: " . $_FILES["foto_file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["foto_file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["foto_file"]["tmp_name"] . "<br />";

        echo "Upload: " . $_FILES["fotocareta_file"]["name"] . "<br />";
        echo "Type: " . $_FILES["fotocareta_file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["fotocareta_file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["fotocareta_file"]["tmp_name"] . "<br />";

        if (file_exists("../../images/pessoas/" . $_FILES["foto_file"]["name"]) && file_exists("../../images/pessoas/" . $_FILES["fotocareta_file"]["name"]))
        {
            echo "Ja existe um arquivo com o mesmo nome que voce está tentando salvar.<br />
                  Por favor, salve com outro nome";
            exit;
        }
        else
        {
            $caminho = "images/pessoas/" . $_FILES["foto_file"]["name"];
            move_uploaded_file($_FILES["foto_file"]["tmp_name"],"../../".$caminho);
            chmod("../../".$caminho, 0777);
            echo "Stored in: " . "../../images/pessoas/" . $_FILES["foto_file"]["name"];

            $caminho_careta = "images/pessoas/" . $_FILES["fotocareta_file"]["name"];
            move_uploaded_file($_FILES["fotocareta_file"]["tmp_name"],"../../".$caminho_careta);
            chmod("../../".$caminho_careta, 0777);
            echo "Stored in: " . "../../images/pessoas/" . $_FILES["fotocareta_file"]["name"];
        }
    }

    $resultado_pessoas_update_query = "INSERT INTO pessoas (nome, cargo, depoimento, tipo, foto, foto_careta, mostrar) VALUES(";
    foreach($_POST as $key => $value)
    {
        if($key != 'submit' && $key != 'mostrar')
        {
            $resultado_pessoas_update_query .= "'".$value."', ";
        }
    }

    $resultado_pessoas_update_query .= "'".$caminho."',";
    $resultado_pessoas_update_query .= "'".$caminho_careta."',";
    $resultado_pessoas_update_query .= "".$mostrar."";
    $resultado_pessoas_update_query .= ")";
    echo $resultado_pessoas_update_query;
    mysql_query($resultado_pessoas_update_query);
    header("location: index.php?sucesso=sim");
}

?>