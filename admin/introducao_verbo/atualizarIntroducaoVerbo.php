<?php
include_once('../includes/topo.php');
//trazer dados do banco de dados

$thisUrl = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

if(@$_GET['deletar'] == 'sim')
{
    $query_deletar = "DELETE FROM introducao_verbo where id = ".$_GET['id'];
    echo $query_deletar."<br />";
    $img = $_GET['img'];
    echo "<img src='../../$img' />";
    @unlink('../../'.$img);
    mysql_query($query_deletar);
    echo "<script type='text/javascript'>top.location.href= 'index.php?sucesso=sim';</script>";
}

else if(!isset($_POST['submit'])){

    $id = $_REQUEST['id'];
    mysql_query("SET NAMES utf8");
    $sql = "SELECT * from `introducao_verbo` where id = $id ";
    $resultado = mysql_query($sql);
    $verbo = mysql_fetch_array($resultado);
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
    <fieldset id="introducao_verbo_fieldset">
    <legend><b>Editar/Atualizar Verbos</b></legend>
    <form enctype="multipart/form-data" class="introducao_verbo_form" action="<?php echo $thisUrl ?>" method="post">
        <table>

        <tr>
            <td><label for="nome_verbo">Nome: </label></td>
            <td><input type="text" name="nome_verbo" id="nome_verbo" value="<?php echo $verbo['nome_verbo']; ?>" /></td>
        </tr>

        <tr>
        <td><label for="imagem_file">Imagem de Fundo: </label></td>
        <td>
            <img width="150px" height="40px" src='<?php echo "../../".$verbo['imagem_fundo'] ?>' />
            <input type="hidden" name="imagem_antiga" value='<?php echo $verbo['imagem_fundo'] ?>' />
            <br />
            <input type="file" name="imagem_file" id="imagem_file" />
        </td>
        </tr>
        <!---->
        <tr>
        <td><label for="ficha_tecnica">Ficha Técnica: </label></td>
        <td><textarea name="ficha_tecnica" id="ficha_tecnica" class="tinymce">
                <?php echo $verbo['ficha_tecnica']; ?>
            </textarea>
        </td>
        </tr>

        <tr>
            <td><label for="mostrar">Mostrar: </label></td>
            <td>
            <input type="checkbox"  name="mostrar" id="mostrar" <?php if($verbo['mostrar'] == true){ echo "checked"; }?> />
            </td>
        </tr>
        <!-- -->

        <tr>
        <td>&nbsp;
        <!-- mandando o campo id para a realização da exclusão ou atualização dos dados -->
        <input name="id" id="id" type="hidden" value="<?php echo $id; ?>" />
        </td>
        <td><input type="submit" name="submit" value="Atualizar" /></td>
        </tr>
        </table>
    </form>
        <?php $urlDeletar = $thisUrl."&deletar=sim&img=".$verbo['imagem_fundo'];?>
        <button id="botao_deletar_verbo" onclick="deletar('<?php echo $urlDeletar; ?>')" >Deletar</button>
</fieldset>

    <?php
    include_once('../includes/rodape.php');
    }
    else
    {
        //pegando o id do verbo para utilizar na cláusula
        $id = $_POST['id'];

        if($_POST['mostrar'] == '')
        {
            $mostrar = 0;
        }
        else
        {
            $mostrar = 1;
        }

        if ($_FILES["imagem_file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["imagem_file"]["error"] . "<br />";
            echo "arquivo não foi atualizado seguir fluxo 2 sem atualizar o arquivo";
            //atualizar nome do arquivo com o nome antigo
            $imagem_fundo = $_POST['imagem_antiga'];
            //passando a variável $logo_file para $caminho para ser gravada no banco de dados
            $caminho = $imagem_fundo;

        }
        else
        {

            //excluir imagem antiga que estava no servidor e atualizar caminho
            $imagem_antiga = $_POST['imagem_antiga'];


            echo $imagem_antiga;
            @unlink("../../".$imagem_antiga);


            echo "arquivo foi atualizado seguir fluxo a partir daqui";
            echo "Upload: " . $_FILES["imagem_file"]["name"] . "<br />";
            echo "Type: " . $_FILES["imagem_file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["imagem_file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $_FILES["imagem_file"]["tmp_name"] . "<br />";
            echo $imagem_file = $_FILES["imagem_file"]["name"];

            if (file_exists("../../images/verbos/" .$imagem_file))
            {
                echo  "<script>
                        window.location.href = '".$thisUrl."&erro=sim';
                      </script>";
                exit;
            }
            else
            {
                $caminho = "images/verbos/" .$imagem_file;
                move_uploaded_file($_FILES["imagem_file"]["tmp_name"],"../../".$caminho);
                chmod("../../".$caminho, 0777);
                echo "Stored in: " . "upload/" .$imagem_file;
            }

        }

        $resultado_verbo_update_query = "UPDATE introducao_verbo SET ";
        foreach($_POST as $key => $value)
        {
            //adiconar chaves que não devem ser incluidas na query
            if($key != 'submit' && $key != 'imagem_antiga' && $key != 'id' && $key != 'mostrar')
            {
                $resultado_verbo_update_query .= $key." = '".$value."', ";
            }
        }
        //
        $resultado_verbo_update_query .= "imagem_fundo = '".$caminho."',";
        $resultado_verbo_update_query .= "mostrar = ".$mostrar."";
        $resultado_verbo_update_query .= " WHERE id = ".$id;

        echo $resultado_verbo_update_query;

        mysql_query("SET NAMES utf8");
        mysql_query($resultado_verbo_update_query);

        echo "<script type='text/javascript'>top.location.href= 'index.php?sucesso=sim';</script>";
    }

?>
