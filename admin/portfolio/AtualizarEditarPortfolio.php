<?php
include_once('../includes/topo.php');
//trazer dados do banco de dados

$thisUrl = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

if(@$_GET['deletar'] == 'sim')
{
    $query_deletar = "DELETE FROM portfolio where id = ".$_GET['id'];
    echo $query_deletar."<br />";
    $img_grande = $_GET['img_grande'];
    echo "<img src='../../$img_grande' />";
    $img_pequena = $_GET['img_pequena'];
    echo "<img src='../../img_pequena' />";
    @unlink('../../'.$img_grande);
    @unlink('../../'.$img_pequena);
    mysql_query($query_deletar);
    echo "<script type='text/javascript'>top.location.href= 'index.php?sucesso=sim';</script>";
}

else if(!isset($_POST['submit'])){

    $id = $_REQUEST['id'];
    mysql_query("SET NAMES utf8");
    $sql = "SELECT * from `portfolio` where id = $id ";
    $resultado = mysql_query($sql);
    $portfolio = mysql_fetch_array($resultado);
    if(@$_GET['erro'] == 'sim' )
    {
        echo "<script>
                $(document).ready(function() {
                    $('.erro').html('<strong>Erro na atualização.</strong><br />Já existe uma imagem no servidor com o mesmo nome da imagem que você está tentando salvar.'+
                                    'Por favor, mude o nome da imagem antes de fazer o upload<br /><br />');
                });
              </script>";
    }

?>
    <script type="text/javascript">
        function deletar(deletarUrl)
        {
            window.location.href = deletarUrl;
        }
    </script>
    <div style="color: red;" class="erro"></div>
    <fieldset id="portfolio_fieldset">
<legend><b>Editar/Atualizar Portfolio</b></legend>
    <form enctype="multipart/form-data" class="portfolio_form" action="<?php echo $thisUrl ?>" method="post">
        <table>
            <!-- Foto Pequena, Foto Grande,  Descrição -->
        <tr>
            <td><label for="fotopequena_file">Foto Pequena: </label></td>
            <td>
                <img width="150px" height="40px" src="<?php echo "../../".$portfolio['foto_pequena'] ?>" />
                <input type="hidden" name="imagempequena_antiga" value="<?php echo $portfolio['foto_pequena'] ?>" />
                <input type="file" name="fotopequena_file" id="fotopequena_file" />
            </td>
        </tr>

        <tr>
            <td><label for="fotogrande_file">Foto Grande: </label></td>
            <td>
                <img width="150px" height="40px" src="<?php echo "../../".$portfolio['foto_grande'] ?>" />
                <input type="hidden" name="imagemgrande_antiga" value="<?php echo $portfolio['foto_grande'] ?>" />
                <input type="file" name="fotogrande_file" id="fotogrande_file" />
            </td>
        </tr>
        <!---->
        <tr>
        <td><label for="descricao">Descrição: </label></td>
        <td><input type="text" name="descricao" id="descricao" value="<?php echo $portfolio['descricao']; ?>" /></td>
        </tr>

        <tr>
        <td>&nbsp;
        <!-- mandando o campo id para a realização da exclusão ou atualização dos dados -->
        <input name="id" id="id" type="hidden" value="<?php echo $id; ?>" />
        </td>
        <td><input type="submit" name="submit" value="Atualizar" /></td>
        </tr>
        </table>
    </form>
        <?php $urlDeletar = $thisUrl."&deletar=sim&img_grande=".$portfolio['foto_grande']."&img_pequena=".$portfolio['foto_pequena'];?>
        <button id="botao_deletar_portfolio" onclick="deletar('<?php echo $urlDeletar; ?>')" >Deletar</button>
</fieldset>

    <?php
    include_once('../includes/rodape.php');
    }
    else
    {
        //pegando o id do portfolio para utilizar na cláusula
        $id = $_POST['id'];

        if ($_FILES["fotopequena_file"]["error"] > 0 && $_FILES["fotopequena_file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["fotopequena_file"]["error"] . "<br />";
            echo "Return Code: " . $_FILES["fotopequena_file"]["error"] . "<br />";
            //
            echo "arquivo não foi atualizado seguir fluxo 2 sem atualizar o arquivo";
            //atualizar nome do arquivo com o nome antigo
            //
            $imagem_fundo_grande = $_POST['imagemgrande_antiga'];
            //passando a variável $logo_file para $caminho para ser gravada no banco de dados
            $caminho_grande = $imagem_fundo_grande;
            //
            $imagem_fundo_pequena = $_POST['imagempequena_antiga'];
            //passando a variável $logo_file para $caminho para ser gravada no banco de dados
            $caminho_pequeno = $imagem_fundo_pequena;

        }
        else
        {

            //excluir imagem antiga que estava no servidor e atualizar caminho
            $imagemgrande_antiga = $_POST['imagemgrande_antiga'];
            $imagempequena_antiga = $_POST['imagempequena_antiga'];

            if (file_exists("../../images/portfolio/" . $_FILES["fotopequena_file"]["name"]) && file_exists("../../images/portfolio/" . $_FILES["fotogrande_file"]["name"]))
            {
                echo "Ja existe um arquivo com o mesmo nome que voce está tentando salvar.<br />
                  Por favor, salve com outro nome";
                exit;
            }
            else
            {
                $caminho_grande = "images/portfolio/" . $_FILES["fotogrande_file"]["name"];
                $caminho_pequeno = "images/portfolio/" . $_FILES["fotopequena_file"]["name"];
                //
                move_uploaded_file($_FILES["fotopequena_file"]["tmp_name"],"../../".$caminho_grande);
                move_uploaded_file($_FILES["fotogrande_file"]["tmp_name"],"../../".$caminho_pequeno);
                //
                chmod("../../".$caminho_grande, 0777);
                chmod("../../".$caminho_pequeno, 0777);
                //
                echo "Stored in: " . "../../images/portfolio/" . $_FILES["fotopequena_file"]["name"];
                echo "Stored in: " . "../../images/portfolio/" . $_FILES["fotogrande_file"]["name"];
            }

            echo $imagemgrande_antiga;
            echo $imagempequena_antiga;
            @unlink("../../".$imagemgrande_antiga);
            @unlink("../../".$imagempequena_antiga);

            echo "Upload: " . $_FILES["fotopequena_file"]["name"] . "<br />";
            echo "Type: " . $_FILES["fotopequena_file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["fotopequena_file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $_FILES["fotopequena_file"]["tmp_name"] . "<br />";

            echo "Upload: " . $_FILES["fotogrande_file"]["name"] . "<br />";
            echo "Type: " . $_FILES["fotogrande_file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["fotogrande_file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $_FILES["fotogrande_file"]["tmp_name"] . "<br />";

        }

        $resultado_portfolio_update_query = "UPDATE portfolio SET ";
        foreach($_POST as $key => $value)
        {
            //adiconar chaves que não devem ser incluidas na query
            if($key != 'submit' && $key != 'imagempequena_antiga' && $key != 'imagemgrande_antiga' && $key != 'id')
            {
                $resultado_portfolio_update_query .= $key." = '".$value."', ";
            }
        }
        //
        $resultado_portfolio_update_query .= "foto_pequena = '".$caminho_pequeno."', ";
        $resultado_portfolio_update_query .= "foto_grande = '".$caminho_grande."'";
        $resultado_portfolio_update_query .= " WHERE id = ".$id;

        echo $resultado_portfolio_update_query;
        mysql_query("SET NAMES utf8");
        mysql_query($resultado_portfolio_update_query);

        echo "<script type='text/javascript'>top.location.href= 'index.php?sucesso=sim';</script>";
    }

?>
