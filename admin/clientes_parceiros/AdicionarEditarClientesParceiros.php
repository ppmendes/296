<?php
include_once('../includes/topo.php');
//trazer dados do banco de dados

$thisUrl = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

if(@$_GET['deletar'] == 'sim')
{
    $query_deletar = "DELETE FROM clientes_parceiros where id = ".$_GET['id'];
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
    $sql = "SELECT * from `clientes_parceiros` where id = $id ";
    $resultado = mysql_query($sql);
    $cliente_parceiro = mysql_fetch_array($resultado);
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
    <fieldset id="clientes_parceiros_fieldset">
<legend><b>Editar/Atualizar Parceiros, Clientes Antigos ou Clientes Atuais</b></legend>
    <form enctype="multipart/form-data" class="clientes_parceiros_form" action="<?php echo $thisUrl ?>" method="post">
        <table>
        <!-- logo (file), link (text), tipo (combobox), motrar (checkbox) -->
        <tr>
            <td><label for="nome">Nome: </label></td>
            <td><input type="text" name="nome" id="nome" value="<?php echo $cliente_parceiro['nome'] ?>" /></td>
        </tr>

        <tr>
        <td><label for="logo_file">Logo: </label></td>
        <td>
            <img width="150px" height="40px" src="<?php echo "../../".$cliente_parceiro['logo'] ?>" />
            <input type="hidden" name="imagem_antiga" value="<?php echo $cliente_parceiro['logo'] ?>" />
            <input type="file" name="logo_file" id="logo_file" />
        </td>
        </tr>
        <!---->
        <tr>
        <td><label for="link">Link: </label></td>
        <td><input type="text" name="link" id="link" value="<?php echo $cliente_parceiro['link']; ?>" /></td>
        </tr>
        <!-- -->
        <tr>
        <td><label for="tipo">Tipo: </label></td>
        <td>
            <select id="tipo" name="tipo">
            <option value="cliente_atual" <?php if($cliente_parceiro['tipo'] == 'cliente_atual'){ echo "selected"; }?> >Cliente Atual</option>
            <option value="cliente_antigo" <?php if($cliente_parceiro['tipo'] == 'cliente_antigo'){ echo "selected"; }?> >Cliente Antigo</option>
            <option value="parceiro"  <?php if($cliente_parceiro['tipo'] == 'parceiro'){ echo "selected"; }?> >Parceiro</option>
            </select>
        </td>
        </tr>

        <tr>
        <td><label for="mostrar">Mostrar: </label></td>
        <td><input type="checkbox" name="mostrar" id="mostrar" <?php if($cliente_parceiro['mostrar'] == true){ echo "checked"; }?> /></td>
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
        <?php $urlDeletar = $thisUrl."&deletar=sim&img=".$cliente_parceiro['logo'];?>
        <button id="botao_deletar_cliente_parceiro" onclick="deletar('<?php echo $urlDeletar; ?>')" >Deletar</button>
</fieldset>

    <?php
    include_once('../includes/rodape.php');
    }
    else
    {
        //pegando o id do cliente_parceiro para utilizar na cláusula
        $id = $_POST['id'];

        if ($_FILES["logo_file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["logo_file"]["error"] . "<br />";
            echo "arquivo não foi atualizado seguir fluxo 2 sem atualizar o arquivo";
            //atualizar nome do arquivo com o nome antigo
            $logo_file = $_POST['imagem_antiga'];
            //passando a variável $logo_file para $caminho para ser gravada no banco de dados
            $caminho = $logo_file;

        }
        else
        {

            //excluir imagem antiga que estava no servidor e atualizar caminho
            $imagem_antiga = $_POST['imagem_antiga'];


            echo $imagem_antiga;
            @unlink("../../".$imagem_antiga);


            echo "arquivo foi atualizado seguir fluxo a partir daqui";
            echo "Upload: " . $_FILES["logo_file"]["name"] . "<br />";
            echo "Type: " . $_FILES["logo_file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["logo_file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $_FILES["logo_file"]["tmp_name"] . "<br />";

            echo $logo_file = $_FILES["logo_file"]["name"];


            if($_POST['tipo'] == "parceiro"){
                if (file_exists("../../images/parceiros/" .$logo_file))
                {
                    echo  "<script>
                            window.location.href = '".$thisUrl."&erro=sim';
                          </script>";
                    exit;
                }
                else
                {
                    $caminho = "images/parceiros/" .$logo_file;
                    move_uploaded_file($_FILES["logo_file"]["tmp_name"],"../../".$caminho);
                    chmod("../../".$caminho, 0777);
                    echo "Stored in: " . "upload/" .$logo_file;
                }
            }
            else
            {
                if (file_exists("../../images/clientes/" .$logo_file))
                {
                    echo "<script>
                            window.location.href = '".$thisUrl."&erro=sim';
                          </script>";
                    exit;
                }
                else
                {
                    $caminho = "images/clientes/" .$logo_file;
                    move_uploaded_file($_FILES["logo_file"]["tmp_name"],"../../".$caminho);
                    chmod("../../".$caminho, 0777);
                    echo "Stored in: " . "../../images/clientes/".$logo_file;
                }
            }
        }


        if($_POST['mostrar'] == '')
        {
            $mostrar = 0;
        }
        else
        {
            $mostrar = 1;
        }

        $resultado_cliente_parceiro_update_query = "UPDATE clientes_parceiros SET ";
        foreach($_POST as $key => $value)
        {
            //adiconar chaves que não devem ser incluidas na query
            if($key != 'submit' && $key != 'mostrar' && $key != 'imagem_antiga' && $key != 'id')
            {
                $resultado_cliente_parceiro_update_query .= $key." = '".$value."', ";
            }
        }
        //
        $resultado_cliente_parceiro_update_query .= "mostrar = '".$mostrar."',";
        $resultado_cliente_parceiro_update_query .= "logo = '".$caminho."'";
        $resultado_cliente_parceiro_update_query .= " WHERE id = ".$id;

        mysql_query("SET NAMES utf8");
        mysql_query($resultado_cliente_parceiro_update_query);

        echo "<script type='text/javascript'>top.location.href= 'index.php?sucesso=sim';</script>";
    }

?>
