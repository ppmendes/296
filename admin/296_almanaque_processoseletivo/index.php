<?php

include_once('../includes/topo.php');
//trazer dados do banco de dados
//
if(!isset($_POST['submit'])){

mysql_query("SET NAMES utf8");
$sql = "SELECT * from `296_almanaque_processoseletivo` ";
$query = mysql_query($sql);
$resultado_296_almanaque_processoseletivo = mysql_fetch_assoc($query);

?>

    <form class="almanaque_processoseletivo_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="296_descricao">Quem Somos: </label>
        <textarea name="296_descricao" id="296_descricao" class="tinymce" >
        <?php echo $resultado_296_almanaque_processoseletivo['296_descricao'] ?>
        </textarea><br />

        <label for="296_historico" >Histórico: </label>
        <textarea name="296_historico" id="296_historico" class="tinymce" >
        <?php echo $resultado_296_almanaque_processoseletivo['296_historico'] ?>
        </textarea><br />

        <label for="296_missao">Missão: </label>
        <textarea name="296_missao" id="296_missao" class="tinymce" >
        <?php echo $resultado_296_almanaque_processoseletivo['296_missao'] ?>
        </textarea><br />

        <label for="296_valores">Valores: </label>
        <textarea name="296_valores" id="296_valores" class="tinymce">
        <?php echo $resultado_296_almanaque_processoseletivo['296_valores'] ?>
        </textarea><br />

        <label for="processo_seletivo_descricao">Processo Seletivo: </label>
        <textarea name="processo_seletivo_descricao" id="processo_seletivo_descricao" class="tinymce" >
        <?php echo $resultado_296_almanaque_processoseletivo['processo_seletivo_descricao'] ?>
        </textarea><br />

        <label for="almanaque_descricao">Descrição do Almanaque: </label>
        <textarea name="almanaque_descricao" id="almanaque_descricao" class="tinymce">
        <?php echo $resultado_296_almanaque_processoseletivo['almanaque_descricao'] ?>
        </textarea><br />

        <input type="submit" name="submit" value="Atualizar" />
    </form>

<?php
}
else
{
    $resultado_296_almanaque_processoseletivo_update_query = "UPDATE 296_almanaque_processoseletivo SET ";
    $i = 1;
    foreach($_POST as $key => $value)
    {
        if($key != 'submit')
        {
            $resultado_296_almanaque_processoseletivo_update_query .= $key." = '". $value."', ";
        }
        if(sizeof($_POST)-1 == $i && $key != 'submit')
        {
            $resultado_296_almanaque_processoseletivo_update_query .= $key." = '". $value."'";
        }
        $i++;

    }
    //mysql_query("SET NAMES utf8");
    mysql_query($resultado_296_almanaque_processoseletivo_update_query);
    header('location: ../index.php');
}

include_once('../includes/rodape.php');

?>