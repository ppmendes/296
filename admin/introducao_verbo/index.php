<?php
include_once('../includes/topo.php');
//trazer dados do banco de dados
//
mysql_query("SET NAMES utf8");
$sql = "SELECT * from `introducao_verbo` ";
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
<legend><b>Adicionar Verbo na Introdução</b></legend>
    <form enctype="multipart/form-data" class="introducao_verbo_parceiros_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
            <tr>
                <td><label for="nome">Nome: </label></td>
                <td><input type="text" name="nome" id="nome" /></td>
            </tr>

            <tr>
                <td><label for="imagem_file">Imagem de Fundo: </label></td>
                <td><input type="file" name="imagem_file" id="imagem_file" /></td>
            </tr>

            <tr>
                <td><label for="ficha_tecnica">Ficha Técnica: </label></td>
                <td><textarea type="text" name="ficha_tecnica" id="ficha_tecnica"></textarea></td>
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

<fieldset id="verbos_cadastrados_fieldset">
    <legend><b>Verbos Cadastrados</b></legend>
    <table border="1">
        <!-- logo (file), link (text), tipo (combobox), motrar (checkbox) -->
        <thead>
            <tr>
                <th>Nome</th>
                <th>Imagem de Fundo</th>
                <th>Ficha Técnica</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($verbo_introducao = mysql_fetch_array($resultado))
        //for($i = 0 ; $i <2 ;$i++)
        {
              echo '<tr>
                        <td>'.$verbo_introducao['nome_verbo'].'</td>

                        <td><img width="150px" height="50px" src="../../'.$verbo_introducao['imagem_fundo'].'"/></td>

                        <td>'.$verbo_introducao['ficha_tecnica'].'</td>

                        <td>
                            <a class="iframe" href="atualizarIntroducaoVerbo.php?id='.$verbo_introducao['id'].'">
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
// adicionando rodapé
include_once('../includes/rodape.php');
}
else
{
   
    if ($_FILES["imagem_file"]["error"] > 0)
    {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
    else
    {
        echo "Upload: " . $_FILES["imagem_file"]["name"] . "<br />";
        echo "Type: " . $_FILES["imagem_file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["imagem_file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["imagem_file"]["tmp_name"] . "<br />";


            if (file_exists("../../images/verbos/" . $_FILES["imagem_file"]["name"]))
            {
                echo "Ja existe um arquivo com o mesmo nome que voce está tentando salvar.<br />
                      Por favor, volte e salve com outro nome";
                exit;
            }
            else
            {
                $caminho = "images/verbos/" . $_FILES["imagem_file"]["name"];
                move_uploaded_file($_FILES["imagem_file"]["tmp_name"],"../../".$caminho);
                chmod("../../".$caminho, 0777);
                echo "Stored in: " . "upload/" . $_FILES["imagem_file"]["name"];
            }
    }

    $resultado_verbos_insert_query = "INSERT INTO introducao_verbo (nome_verbo, ficha_tecnica, imagem_fundo) VALUES(";

    foreach($_POST as $key => $value)
    {
        if($key != 'submit')
        {
           $resultado_verbos_insert_query .= "'".htmlspecialchars($value)."', ";
        }
    }

   $resultado_verbos_insert_query .= "'".$caminho."'";
   $resultado_verbos_insert_query .= ")";

    echo $resultado_verbos_insert_query;
    mysql_query($resultado_verbos_insert_query);
    header("location: index.php?sucesso=sim");
}

?>