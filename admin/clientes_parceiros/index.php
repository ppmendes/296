<?php
include_once('../includes/topo.php');
//trazer dados do banco de dados
//
mysql_query("SET NAMES utf8");
$sql = "SELECT * from `clientes_parceiros` ";
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
            'width'				: 500,
            'autoScale'			: false,
            'transitionIn'			: 'none',
            'transitionOut'			: 'none',
            'type'				: 'iframe',
            'onComplete' : function() {
                $('#fancybox-frame').load(function() { // wait for frame to load and then gets it's height
                    $('#fancybox-content').height($(this).contents().find('body').height()+30);
                });
            }
        });
    });
</script>

<!-- adicionar clientes -->
<fieldset id="clientes_parceiros_fieldset">
<legend><b>Adicionar Parceiros, Clientes Antigos ou Clientes Atuais</b></legend>
    <form enctype="multipart/form-data" class="clientes_parceiros_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
        <!-- logo (file), link (text), tipo (combobox), motrar (checkbox) -->
        <tr>
            <td><label for="nome">Nome: </label></td>
            <td><input type="text" name="nome" id="nome" /></td>
        </tr>

        <tr>
        <td><label for="logo_file">Logo: </label></td>
        <td><input type="file" name="logo_file" id="logo_file" /></td>
        </tr>
        <!---->
        <tr>
        <td><label for="logo">Link: </label></td>
        <td><input type="text" name="logo" id="logo" /></td>
        </tr>

        <tr>
        <td><label for="tipo">Tipo: </label></td>
        <td><select name="tipo">
            <option value="cliente_atual">Cliente Atual</option>
            <option value="cliente_antigo">Cliente Antigo</option>
            <option value="parceiro">Parceiro</option>
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

<fieldset id="clientes_parceiros_cadastrados_fieldset">
    <legend><b>Clientes e Parceiros Cadastrados</b></legend>
    <table border="1">
        <!-- logo (file), link (text), tipo (combobox), motrar (checkbox) -->
        <thead>
            <tr>
                <th>Nome</th>
                <th>Logo</th>
                <th>Link</th>
                <th>Tipo</th>
                <th>Mostrar</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($cliente_parceiro = mysql_fetch_array($resultado))
        //for($i = 0 ; $i <2 ;$i++)
        {
              echo '<tr>
                    <td>'.$cliente_parceiro['nome'].'</td>

                    <td><img width="150px" height="40px" src="../../'.$cliente_parceiro['logo'].'"/></td>

                    <td><a href="'.$cliente_parceiro['link'].'">'.$cliente_parceiro['link'].'</a></td>

                    <td>'.$cliente_parceiro['tipo'].'</td>

                    <td><input type="checkbox" disabled="disabled" name="mostrar" id="mostrar"';

              //checando se o parceiro é para ser exibido ou não
              if($cliente_parceiro["mostrar"] == true){ echo "checked"; }

              echo ' /></td><td>
                      <a class="iframe" href="AdicionarEditarClientesParceiros.php?id='.$cliente_parceiro['id'].'"><img  src="../../images/ico_editar.gif" />
                      </a></td></tr>';
        }
        ?>
        </tbody>
    </table>
</fieldset>

<?php
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


    if ($_FILES["logo_file"]["error"] > 0)
    {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
    else
    {
        echo "Upload: " . $_FILES["logo_file"]["name"] . "<br />";
        echo "Type: " . $_FILES["logo_file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["logo_file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["logo_file"]["tmp_name"] . "<br />";

        if($_POST['tipo'] == "parceiro"){
            if (file_exists("../../images/parceiros/" . $_FILES["logo_file"]["name"]))
            {
                echo "Ja existe um arquivo com o mesmo nome que voce está tentando salvar.<br />
                      Por favor, salve com outro nome";
                exit;
            }
            else
            {
                $caminho = "images/parceiros/" . $_FILES["logo_file"]["name"];
                move_uploaded_file($_FILES["logo_file"]["tmp_name"],"../../".$caminho);
                chmod("../../".$caminho, 0777);
                echo "Stored in: " . "upload/" . $_FILES["logo_file"]["name"];
            }
        }
        else
        {
            if (file_exists("../../images/clientes/" . $_FILES["logo_file"]["name"]))
            {
                echo "Ja existe um arquivo com o mesmo nome que voce está tentando salvar.<br />
                      Por favor, salve com outro nome";
                exit;
            }
            else
            {
                $caminho = "images/clientes/" . $_FILES["logo_file"]["name"];
                move_uploaded_file($_FILES["logo_file"]["tmp_name"],"../../".$caminho);
                chmod("../../".$caminho, 0777);
                echo "Stored in: " . "../../images/clientes/" . $_FILES["logo_file"]["name"];
            }
        }
    }

    $i = 1;
    $resultado_cliente_parceiro_update_query = "INSERT INTO clientes_parceiros (nome, link, tipo, mostrar, logo) VALUES(";
    foreach($_POST as $key => $value)
    {
        if($key != 'submit' && $key != 'mostrar')
        {
            $resultado_cliente_parceiro_update_query .= "'".htmlspecialchars($value)."', ";
        }
    }

    $resultado_cliente_parceiro_update_query .= "'".$mostrar."',";
    $resultado_cliente_parceiro_update_query .= "'".$caminho."'";
    $resultado_cliente_parceiro_update_query .= ")";

    mysql_query($resultado_cliente_parceiro_update_query);
    header("location: index.php?sucesso=sim");
}
include_once('../includes/rodape.php');
?>