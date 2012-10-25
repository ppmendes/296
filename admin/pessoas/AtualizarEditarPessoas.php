<?php
include_once('../includes/topo.php');
//trazer dados do banco de dados

$thisUrl = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

if(@$_GET['deletar'] == 'sim')
{
    $query_deletar = "DELETE FROM pessoas where id = ".$_GET['id'];
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
    $sql = "SELECT * from `pessoas` where id = $id ";
    $resultado = mysql_query($sql);
    $pessoas = mysql_fetch_array($resultado);
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
    <fieldset id="pessoas_fieldset">
<legend><b>Editar/Atualizar Parceiros, Clientes Antigos ou Clientes Atuais</b></legend>
    <form enctype="multipart/form-data" class="pessoas_form" action="<?php echo $thisUrl ?>" method="post">
        <table>
            <!-- Nome, Foto, Cargo,  Depoimento, Tipo -->
        <tr>
            <td><label for="nome">Nome: </label></td>
            <td><input type="text" name="nome" id="nome" value="<?php echo $pessoas['nome'] ?>" /></td>
        </tr>

        <tr>
        <td><label for="foto_file">Foto: </label></td>
        <td>
            <img width="150px" height="40px" src="<?php echo "../../".$pessoas['foto'] ?>" />
            <input type="hidden" name="imagem_antiga" value="<?php echo $pessoas['foto'] ?>" />
            <br />
            <input type="file" name="foto_file" id="foto_file" />
        </td>
        </tr>

        <tr>
            <td><label for="fotocareta_file">Foto Careta: </label></td>
            <td>
                <img width="150px" height="40px" src="<?php echo "../../".$pessoas['foto_careta'] ?>" />
                <input type="hidden" name="imagemcareta_antiga" value="<?php echo $pessoas['foto_careta'] ?>" />
                <br />
                <input type="file" name="fotocareta_file" id="fotocareta_file" />
            </td>
        </tr>
        <!---->
        <tr>
        <td><label for="cargo">Cargo: </label></td>
        <td><input type="text" name="cargo" id="cargo" value="<?php echo $pessoas['cargo']; ?>" /></td>
        </tr>
        <!-- -->
        <tr>
        <td><label for="tipo">Depoimento: </label></td>
        <td>
            <textarea name="depoimento" class="tinymce" id="depoimento"><?php echo $pessoas['depoimento']; ?></textarea>
        </td>
        </tr>

        <tr>
            <td><label for="tipo">Tipo: </label></td>
            <td>
                <select id="tipo" name="tipo">
                <option value="ex-membro">ex-membro</option>
                <option value="membro">membro</option>
                </select>
            </td>
        </tr>

        <tr>
            <td><label for="mostrar">Mostrar: </label></td>
            <td><input type="checkbox" name="mostrar" id="mostrar" <?php if($pessoas['mostrar'] == true){ echo "checked"; }?> /></td>
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
        <?php $urlDeletar = $thisUrl."&deletar=sim&img=".$pessoas['foto'];?>
        <button id="botao_deletar_pessoas" onclick="deletar('<?php echo $urlDeletar; ?>')" >Deletar</button>
</fieldset>

    <?php
    include_once('../includes/rodape.php');
    }
    else
    {

        //pegando o id do pessoas para utilizar na cláusula
        $id = $_POST['id'];

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
            echo "arquivo não foi atualizado seguir fluxo 2 sem atualizar o arquivo";

            echo "Return Code: " . $_FILES["fotocareta_file"]["error"] . "<br />";
            echo "arquivo não foi atualizado seguir fluxo 2 sem atualizar o arquivo";
            //atualizar nome do arquivo com o nome antigo
            $imagem_fundo = $_POST['imagem_antiga'];
            $imagemcareta_fundo = $_POST['imagemcareta_antiga'];
            //passando a variável $logo_file para $caminho para ser gravada no banco de dados
            $caminho = $imagem_fundo;
            $caminhocareta = $imagemcareta_fundo;

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
                //excluir imagem antiga que estava no servidor e atualizar caminho
                if($_FILES["foto_file"]["name"] != '')
                {
                    echo "arquivo foto foi setado";
                    $imagem_antiga = $_POST['imagem_antiga'];
                    @unlink("../../".$imagem_antiga);

                    $caminho = "images/pessoas/" . $_FILES["foto_file"]["name"];
                    move_uploaded_file($_FILES["foto_file"]["tmp_name"],"../../".$caminho);
                    chmod("../../".$caminho, 0777);
                    echo "Stored in: " . "../../images/pessoas/" . $_FILES["foto_file"]["name"];
                }
                if($_FILES["fotocareta_file"]["name"] != '')
                {
                    echo "arquivo foto careta foi setado";
                    $imagemcareta_antiga = $_POST['imagemcareta_antiga'];
                    @unlink("../../".$imagemcareta_antiga);
                    $caminhocareta = "images/pessoas/" . $_FILES["fotocareta_file"]["name"];
                    move_uploaded_file($_FILES["fotocareta_file"]["tmp_name"],"../../".$caminhocareta);
                    chmod("../../".$caminhocareta, 0777);
                    echo "Stored in: " . "../../images/pessoas/" . $_FILES["fotocareta_file"]["name"];
                }
            }
        }

        $resultado_pessoas_update_query = "UPDATE pessoas SET ";
        foreach($_POST as $key => $value)
        {
            //adiconar chaves que não devem ser incluidas na query
            if($key != 'submit' && $key != 'mostrar' && $key != 'imagem_antiga' && $key != 'id' && $key != 'imagemcareta_antiga')
            {
                $resultado_pessoas_update_query .= $key." = '".$value."', ";
            }
        }
        //
        if($_FILES["foto_file"]["name"] != '')
        {
            $resultado_pessoas_update_query .= "foto = '".$caminho."',";
        }
        if($_FILES["fotocareta_file"]["name"] != '')
        {
            $resultado_pessoas_update_query .= "foto_careta = '".$caminhocareta."',";
        }

        $resultado_pessoas_update_query .= "mostrar = ".$mostrar."";

        $resultado_pessoas_update_query .= " WHERE id = ".$id;


        echo $resultado_pessoas_update_query;
        mysql_query("SET NAMES utf8");
        mysql_query($resultado_pessoas_update_query);

        echo "<script type='text/javascript'>top.location.href= 'index.php?sucesso=sim';</script>";
    }

?>
