<?php
include_once('../includes/topo.php');
//trazer dados do banco de dados
//
mysql_query("SET NAMES utf8");
$sql = "SELECT * from `portfolio` ";
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
<fieldset id="portfolio_fieldset">
<legend><b>Adicionar Portfolio</b></legend>
    <form enctype="multipart/form-data" class="portfolio_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
            <!-- Foto Pequena, Foto Grande,  Descrição -->

        <tr>
        <td><label for="fotopequena_file">Foto Pequena: </label></td>
        <td><input type="file" name="fotopequena_file" id="fotopequena_file" /></td>
        </tr>

        <tr>
            <td><label for="fotogrande_file">Foto Grande: </label></td>
            <td><input type="file" name="fotogrande_file" id="fotogrande_file" /></td>
        </tr>
        <!---->

        <tr>
        <td><label for="descricao">Descrição: </label></td>
        <td><input type="text" name="descricao" id="descricao" /></td>
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

<fieldset id="portfolio_cadastrados_fieldset">
    <legend><b>Portfolio Cadastrados</b></legend>
    <table border="1">
        <!-- Foto Pequena, Foto Grande,  Descrição -->
        <thead>
            <tr>
                <th>Foto Pequena</th>
                <th>Foto Grande</th>
                <th>Descrição</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($portfolio = mysql_fetch_array($resultado))
        {
              echo '<tr>
                    <td><img width="150px" height="40px" src="../../'.$portfolio['foto_pequena'].'"/></td>

                    <td><img width="150px" height="40px" src="../../'.$portfolio['foto_grande'].'"/></td>

                    <td>'.$portfolio['descricao'].'</td>';

              echo   '<td>
                      <a class="iframe" href="AtualizarEditarPortfolio.php?id='.$portfolio['id'].'">
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
  

    if ($_FILES["fotopequena_file"]["error"] > 0 && $_FILES["fotogrande_file"]["error"] )
    {
        echo "Return Code: " . $_FILES["fotopequena_file"]["error"] . "<br />";
        echo "Return Code: " . $_FILES["fotogrande_file"]["error"] . "<br />";
    }
    else
    {
        echo "Upload: " . $_FILES["fotogrande_file"]["name"] . "<br />";
        echo "Type: " . $_FILES["fotogrande_file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["fotogrande_file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["fotogrande_file"]["tmp_name"] . "<br />";

        echo "Upload: " . $_FILES["fotopequena_file"]["name"] . "<br />";
        echo "Type: " . $_FILES["fotopequena_file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["fotopequena_file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["fotopequena_file"]["tmp_name"] . "<br />";

        if (file_exists("../../images/portfolio/" . $_FILES["fotopequena_file"]["name"]) && file_exists("../../images/portfolio/" . $_FILES["fotogrande_file"]["name"]))
        {
            echo "Ja existe um arquivo com o mesmo nome que voce está tentando salvar.<br />
                  Por favor, salve com outro nome";
            exit;
        }
        else
        {
            //
            $caminho_pequeno = "images/portfolio/" . $_FILES["fotopequena_file"]["name"];
            $caminho_grande = "images/portfolio/" . $_FILES["fotogrande_file"]["name"];
            //
            move_uploaded_file($_FILES["fotopequena_file"]["tmp_name"],"../../".$caminho_pequeno);
            move_uploaded_file($_FILES["fotogrande_file"]["tmp_name"],"../../".$caminho_grande);
            //
            chmod("../../".$caminho_pequeno, 0777);
            chmod("../../".$caminho_grande, 0777);
            //
            echo "Stored in: " . "../../images/portfolio/" . $_FILES["fotopequena_file"]["name"];
            echo "Stored in: " . "../../images/portfolio/" . $_FILES["fotogrande_file"]["name"];
        }
    }

    $resultado_portfolio_update_query = "INSERT INTO portfolio (descricao, foto_pequena, foto_grande) VALUES(";
    foreach($_POST as $key => $value)
    {
        if($key != 'submit')
        {
            $resultado_portfolio_update_query .= "'".htmlspecialchars($value)."', ";
        }
    }

    $resultado_portfolio_update_query .= "'".$caminho_pequeno."',";
    $resultado_portfolio_update_query .= "'".$caminho_grande."'";
    $resultado_portfolio_update_query .= ")";
    echo $resultado_portfolio_update_query;
    mysql_query($resultado_portfolio_update_query);
    header("location: index.php?sucesso=sim");
}

?>