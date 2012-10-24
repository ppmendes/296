<?php

//linux
//$base_url = "/var/www/296";
//windows
$base_url = "C:/wamp/www/296";
include($base_url."/login/seguranca.php");

mysql_query("SET NAMES utf8");
//selecionando dados a agência , almanaque e processo seletivo
$sql_296_almanaque_processoseletivo = "SELECT * from `296_almanaque_processoseletivo`";
$resultado_296_almanaque_processoseletivo = mysql_query($sql_296_almanaque_processoseletivo);
$array_296_almanaque_processoseletivo = mysql_fetch_array($resultado_296_almanaque_processoseletivo);

//selecionando dados de clientes_atuais
$sql_clientes_atuais = "SELECT * from `clientes_parceiros` WHERE tipo = 'cliente_atual' and mostrar = 1";
$resultado_clientes_atuais = mysql_query($sql_clientes_atuais);
while($row = mysql_fetch_assoc($resultado_clientes_atuais)){
    $array_clientes_atuais[] = $row;
}


//selecionando dados de clientes_antigos
$sql_clientes_antigos = "SELECT * from `clientes_parceiros` WHERE tipo = 'cliente_antigo' and mostrar = 1";
$resultado_clientes_antigos = mysql_query($sql_clientes_antigos);
while($row = mysql_fetch_assoc($resultado_clientes_antigos)){
    $array_clientes_antigos[] = $row;
}

//selecionando dados de parceiros
$sql_parceiros = "SELECT * from `clientes_parceiros` WHERE tipo = 'parceiro' and mostrar = 1";
$resultado_parceiros = mysql_query($sql_parceiros);
while($row = mysql_fetch_assoc($resultado_parceiros)){
    $array_parceiros[] = $row;
}

//selecionando dados de portfolio
$sql_portfolio = "SELECT * from `portfolio` WHERE mostrar = 1";
$resultado_portfolio = mysql_query($sql_portfolio);
while($row = mysql_fetch_assoc($resultado_portfolio)){
    $array_portfolio[] = $row;
}

mysql_query("SET NAMES utf8");
    $sql_pessoas = "SELECT * from `pessoas` WHERE mostrar = 1";
$resultado_pessoas = mysql_query($sql_pessoas);
while($row = mysql_fetch_assoc($resultado_pessoas)){
    if($row['tipo'] == 'membro')
    {
        $array_pessoas_membros[] = $row;
    }
    if($row['tipo'] == 'ex-membro')
    {
        $array_pessoas_exmembros[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR" class="no-js" ><!--<![endif]-->
<head>

    <title>Alpha v2 | Agência 296</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <meta name="author" content="Betafunda:Web" >
    <meta name="description" content="Agência Junior de Publicidade 296 Publicidade" >
    <meta name="keywords" content="Publicidade, Universidade, Junior, Agência, 296, doisnovemeia, UnB, Univerdidade, Brasília" >

    <script type="text/javascript" src="http://sawpf.com/1.0.js" ></script>

    <link href="main.css" rel="stylesheet" media="screen" type="text/css" >
    <link href="css/scroll.css" rel="stylesheet" media="screen" type="text/css" >
    <link href="fonts/stylesheet.css" rel="stylesheet" media="screen" type="text/css" >

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" >

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" >
    <link rel="apple-touch-icon" href="apple-touch-icon.png" >
    <!-- Script initialization -->

    <script type="text/javascript" src="js/jquery.min.js" ></script>
    <script type="text/javascript" src="js/jquery.anystretch.min.js" ></script>

    <script src="js/jquery-ui-1.8.18.custom.min.js" type="text/javascript" ></script>
    <script src="js/jquery.mousewheel.min.js" type="text/javascript" ></script>
    <script src="js/jquery.smoothdivscroll-1.2-min.js" type="text/javascript" ></script>

    <script type="text/javascript" src="js/jquery.anchor.js" ></script>
    <script type="text/javascript" src="js/widgets.js" ></script>

    <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

    <!-- Scroll Script -->
    <script type="text/javascript" >
        // Initialize the plugin with no custom options
        $(document).ready(function () {
            $("a.fancybox").fancybox({
                'transitionIn'	:	'elastic',
                'transitionOut'	:	'elastic',
                'speedIn'		:	600,
                'speedOut'		:	200,
                'overlayShow'	:	true
            });
            if(window.location.hash == '' || window.location.hash == '#'){
                $('.menu > li > .menu_ativo').removeClass('menu_ativo');
                $('.menu > li > a[href="#agencia"]').addClass('menu_ativo');
            }
            //Menu selecionado
            $('a').click(function(){
                $('.menu > li > .menu_ativo').removeClass('menu_ativo');
                $('.menu > li > a[href="'+this.hash+'"]').addClass('menu_ativo');
            });
            // None of the options are set
            $("section#section_01, section#section_02, section#section_03, section#section_04").smoothDivScroll({});

            $('#section_global_02').anystretch("images/bg/bg_section_02.jpg");
            $('#section_global_04').anystretch("images/bg/bg_section_04.jpg");
            $('#section_global_05').anystretch("images/bg/bg_section_05.jpg");
            $('#section_global_06').anystretch("images/bg/bg_section_06.jpg");

            //section 01
            //subitem do menu: a dois
            $('#a_dois_menu').click(function(){
                $("section#section_01").smoothDivScroll("scrollToElement", "id", "a_dois_section");
            });
            //subitem do menu: histórico
            $('#historico_menu').click(function(){
                $("section#section_01").smoothDivScroll("scrollToElement", "id", "historico_section");
            });
            //subitem do menu: histórico
            $('#missao_valores_menu').click(function(){
                $("section#section_01").smoothDivScroll("scrollToElement", "id", "missao_valores_section");
            });

            //section 02
            //subitem do menu: membros
            $('#membros_menu').click(function(){
                $("section#section_02").smoothDivScroll("scrollToElement", "id", "membros_section");
            });
            //subitem do menu: ex-membros
            $('#exmembros_menu').click(function(){
                $("section#section_02").smoothDivScroll("scrollToElement", "id", "exmembros_section");
            });

            //section 03
            //subitem do menu: clientes
            $('#clientes_menu').click(function(){
                $("section#section_04").smoothDivScroll("scrollToElement", "id", "clientes_section");
            });
            //subitem do menu: parceiros
            $('#parceiros_menu').click(function(){
                $("section#section_04").smoothDivScroll("scrollToElement", "id", "parceiros_section");
            });
        });

        function onMouseOverImagemPessoas(id,nome, cargo, imagem)
        {
            //alert(imagem);
            //atualizaNomeCargoMembro
            $('#nomeMembro').html(nome);
            $('#cargoMembro').html(cargo);

            //mudar css
            $('#'+id).css('background-image','url('+imagem+')');

        }
    </script>
</head>

<body style="width:100%; height:100%; margin:0; " >

<a name="agencia" id="agencia" ></a>

<section class="section_global" >
<section class="nav" >
    <nav class="nav_global" >
        <div id="nav_center" >
            <ul class="menu" >
                <li>
                    <a href="#agencia" class="anchorLink" >Agência</a>
                    <ul id="submenu1" >
                        <li class="li2" ><a  id="a_dois_menu" href="#agencia" class="anchorLink" >A Dois</a></li>
                        <li><a id="historico_menu" href="#agencia" class="anchorLink" >Histórico</a></li>
                        <li><a id="missao_valores_menu" href="#agencia" class="anchorLink" >Missão e Valores</a></li>

                    </ul>
                    <div class="div_space" ></div>
                </li>
                <li>
                    <a href="#pessoas" class="anchorLink" >Pessoas</a>
                    <ul id="submenu2" >
                        <li class="li2" ><a id="membros_menu" href="#pessoas" class="anchorLink" >Membros</a></li>
                        <li><a id="exmembros_menu" href="#pessoas" class="anchorLink" >Ex-Membros</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#portfolio" class="anchorLink" >Portifólio</a>
                </li>
                <li>
                    <a href="#com_a_gente" class="anchorLink" >Com a Gente</a>
                    <ul id="submenu4" >
                        <li class="li2" ><a id="clientes_menu" href="#com_a_gente" class="anchorLink" >Clientes</a></li>
                        <li><a id="parceiros_menu" href="#com_a_gente" class="anchorLink" >Parceiros</a></li>
                    </ul>
                </li>
                <li><a href="#almanaque" class="anchorLink" >Almanaque</a></li>
                <li><a href="#processo_seletivo" class="anchorLink" >Processo Seletivo</a></li>
                <li><a href="#contato" class="anchorLink" >Contato</a></li>
                <li style="float:right; " >
                    <a href="intro/intro.php" style="color:#70B048; " >Intro</a></li>

            </ul>
        </div>
    </nav>
</section>

<section style="width:100%; height:80px; float:none; margin-bottom:0; background-image:url(images/bg/pattern1.jpg); position:relative; margin-left:auto; margin-right:auto; display:block; " ></section>

<section id="section_global_01" style="background-image:url(images/bg/pattern1.jpg); height:auto; " >
    <section style="width:100%; height:800px; margin-left:0%; " >
        <section id="section_01" >

            <a name="a_dois" ></a>
            <section id="a_dois_section" class="logo_slice_01" style="background-image:url(images/logo.gif); margin-top:0; " ></section>

            <a name="a_dois" id="a_dois" ></a>
            <section style="height:600px; margin-left:150px; float:left; position:relative; margin-top:50px; margin-right:150px; " >
                <header class="header_title" id="header_section_01" >Quem somos</header>
                <div class="line" id="line_section_01" ></div>
                <article class="article_global" id="article_slice_01" >
                    <?php echo $array_296_almanaque_processoseletivo['296_descricao']; ?>
                </article>
                <div class="line" id="line_section_01" >
                </div>

                <div id="redessociais">
                    <!-- facebook -->
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=483416835011701";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-like" data-href="https://www.facebook.com/Doisnovemeia" data-send="false" data-layout="button_count" data-width="250" data-show-faces="false" data-font="verdana">
                    </div>
                    <!-- twitter -->
                    <a href="https://twitter.com/doisnovemeia" class="twitter-follow-button" data-show-count="false" data-lang="pt" data-show-screen-name="false">Seguir @doisnovemeia</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>

            </section>

            <a name="historico" id="historico" ></a>
            <section id="historico_section" style="width:auto; height:700px; float:left; position:relative; margin-top:50px; margin-left:150px; margin-right:150px; padding-left:50px; padding-right:50px; " >
                <header class="header_title" id="header_section_01" >Nossa caminhada</header>
                <div class="line" id="line_section_01" ></div>
                <article class="article_global" id="article_slice_01" >
                    <?php echo $array_296_almanaque_processoseletivo['296_historico']; ?>
                </article>

                <section style="width:auto; " >

                    <div class="section_logo_date" >
                        <figure class="figure_logo" style="background-image:url(images/296_1996.png); " ></figure>
                        <section style="float:right; margin-top:20px; " >
                            <div class="line_date" id="line_date_right" ></div>
                            <div class="text_logo_date" >1996</div>
                            <div style="clear:both; " ></div>
                        </section>
                    </div>

                    <div class="section_logo_date" >
                        <figure class="figure_logo" style="background-image:url(images/296_2000.png); " ></figure>
                        <section style="margin-top:20px; float:inherit; width:100%; " >
                            <div class="line_date" id="line_date_left" ></div>
                            <div class="text_logo_date" >2000</div>
                            <div class="line_date" id="line_date_right" ></div>
                            <div style="clear:both; " ></div>
                        </section>
                    </div>

                    <div class="section_logo_date" >
                        <figure class="figure_logo" style="background-image:url(images/296_2010.png); " ></figure>
                        <section style="float:left; margin-top:20px; " >
                            <div class="line_date" id="line_date_left" ></div>
                            <div class="text_logo_date" >2010</div>
                            <div style="clear:both; " ></div>
                        </section>
                    </div>

                    <div style="clear:both; " >
                    </div>
                </section>
            </section>


            <a name="missao" id="missao" ></a>
            <section id="missao_valores_section" class="circle_section01" style="margin-left:245px; " >
                <header class="header_title" id="header_section_01" >Missão</header>

                <article class="article_global" id="article_slice_01" style="margin-left:65px; " >
                    <?php echo $array_296_almanaque_processoseletivo['296_missao']; ?>
                </article>

            </section>

            <a name="missao" id="missao" ></a>
            <section class="circle_section01" style="margin-left:-45px; margin-right:250px; " >
                <header class="header_title" id="header_section_01" >Valores</header>

                <article class="article_global" id="article_slice_01" style="margin-left:80px; " >
                    <?php echo $array_296_almanaque_processoseletivo['296_valores']; ?>
                </article>
            </section>
        </section>
    </section>
    <section class="divisor" id="divisor_down" ></section>
</section>


<a id="pessoas" ></a>
<section id="section_global_02" style="height:auto; " >
    <section style="width:100%; height:auto; margin-left:0%; margin-bottom:100px; " >
        <section id="section_02" >

            <a id="membros" ></a>
            <section id="membros_section" class="section_alphablack" id="alphablack_membros" >
                <section id="note_pessoas" >
                    <hgroup>
                        <header id="nomeMembro" class="header_section_02" style="height: 15px; color:#4DB848; font-weight:bold; margin-top:20px; " ></header>
                        <header id="cargoMembro" class="header_section_02" style="height: 20px; color:#4DB848; font-style:oblique; margin-top:5px; " ></header>
                    </hgroup>
                    <article class="header_section_02" style="color:#FFFFFF; font-weight:normal; margin-top:10px; " >
                        Cada membro passa<br>
                        cerca de um ano e dois<br>
                        meses aqui, e essas são<br>
                        as pessoas que estão na<br>
                        Doisnovemeia hoje.<br>
                    </article>
                </section>

                <div style="float:left; width:760px; position:relative; margin-top:0; margin-left:0; height:auto; " >
                    <?php
                    for($i = 0 ; $i < sizeof($array_pessoas_membros) && $i < 16; $i++)
                    {
                         $pessoas_membros = $array_pessoas_membros[$i];
                    ?>
                        <figure id="membro_<?php echo $pessoas_membros['id']; ?>" onmouseover="onMouseOverImagemPessoas('membro_<?php echo $pessoas_membros['id']; ?>','<?php echo $pessoas_membros['nome']; ?>','<?php echo $pessoas_membros['cargo']; ?>','<?php echo $pessoas_membros['foto_careta'] ?>');" onmouseout="onMouseOverImagemPessoas('membro_<?php echo $pessoas_membros['id']; ?>','','','<?php echo $pessoas_membros['foto'] ?>');" class="figure_pessoas" style="background-image:url(<?php echo $pessoas_membros['foto'] ?>); " ></figure>
                    <?php
                    }
                    ?>
                </div>

                <div style="width:990px; position:relative; margin-top:0; margin-left:0; height:auto; float: left;" >
                    <?php
                    for($i >= 16 ; $i < sizeof($array_pessoas_membros) && $i >= 16; $i++)
                    {
                        $pessoas_membros = $array_pessoas_membros[$i];
                    ?>
                        <figure id="membro_<?php echo $pessoas_membros['id']; ?>" onmouseover="onMouseOverImagemPessoas('membro_<?php echo $pessoas_membros['id']; ?>','<?php echo $pessoas_membros['nome']; ?>','<?php echo $pessoas_membros['cargo']; ?>','<?php echo $pessoas_membros['foto_careta'] ?>');" onmouseout="onMouseOverImagemPessoas('membro_<?php echo $pessoas_membros['id']; ?>','','','<?php echo $pessoas_membros['foto'] ?>');" class="figure_pessoas" style="background-image:url(<?php echo $pessoas_membros['foto'] ?>); " ></figure>
                    <?php
                    }
                    ?>
                </div>
            </section>

            <a id="exmembros" ></a>
            <section id="exmembros_section" class="section_alphablack" id="alphablack_exmembros" >
                <section style="width: 200px; float: left; overflow: hidden; margin-left: 170px; margin-top: 170px;">
                    <article class="header_section_02" style="color:#FFFFFF; font-weight:normal; margin-top:10px; " >
                        Temos mais de 300 ex-membros<br>
                        e alguns deles já passaram por<br>
                        grandes empresas e agências<br>
                        do mundo todo,como Google,<br>
                        Microsoft, Almap BBDO e<br>
                        Santa Clara Nitro.<br><br>
                    </article>
                    <footer style="text-align: right;">
                        <a href="#" style="color:#4DB848; text-decoration: none;">Se você é ex-membro envie<br>
                        também seu depoimento.</a>
                    </footer>
                </section>
                <section style="height: 130px; float: left; border-left: solid 1px #FFFFFF; margin-top: 190px; margin-left: 10px;">&nbsp;</section>
                <section style="min-height:480px; width: 500px; float: left; overflow: hidden; margin-top: 170px;">
                    <article class="header_section_02" style="font-family:'PopulaireMedium';white-space: normal; color:#FFFFFF; font-weight:normal; margin-top:10px; font-size: 32px; line-height: 40px; " >
                        <image src="images/abre_aspas.png">
                            A DOIS É UM LUGAR ONDE A
                            GENTE APRENDE MUITO E FAZ
                            GRANDES AMIGOS AO MESMO TEMPO.
                            PARECE MESA DE BAR, SÓ QUE SEM O
                            BAR... E ÀS VEZES SEM A MESA.
                            <image src="images/fecha_aspas.png">
                    </article>

                    <footer style="text-align: right; color:#4DB848;">
                        Thiagoogo Hfgoog, ex-alguma coisa vai aqui.
                    </footer>

                    <nav style="text-align: center; margin-top:20px;">
                        <a href="#" style="padding-right: 10px;"><img src="images/seta_esquerda.png"></a>
                        <a href="#" style="padding-left: 10px;"><img src="images/seta_direita.png"></a>
                    </nav>
                </section>
            </section>
        </section>
    </section>
    <section class="divisor" id="divisor_down" ></section>
</section>

<a id="portfolio" ></a>
<section id="section_global_03" style="background-image:url(images/bg/pattern2.jpg); height:auto; " >
    <section style="width:100%; height:800px; margin-left:0%; " >
        <section id="section_03" class="portifolio_section" >

            <section class="portifolio_hgroup" >

                <header class="header_title" id="header_section_03" >Nosso trabalho</header>

                <div class="line" id="line_section_03" ></div>

                <article id="portifolio_article" >
                    Quem ama o que faz sai mostrando seu<br>
                    trabalho pra todo mundo. Com a gente não é<br>
                    diferente. É por isso que colocamos aqui os<br>
                    nossos melhores trabalhos para você dar uma<br>
                    olhadinha. Não são uns tchuco tchucos?<br>
                </article>
            </section>

            <?php foreach($array_portfolio as $portfolio): ?>
                <section class="portifolio_div" >

                    <section class="portifolio_item" style="background-image:url('<?php echo $portfolio['foto_pequena']; ?>'); " >
                        <a class="fancybox" href="<?php echo $portfolio['foto_grande']; ?>" target="" name="" ><section style="width:100%; height:100%; " >
                            <header class="portifolio_header" ><?php echo $portfolio['descricao']; ?><br></header>
                        </section></a>
                    </section>

                </section>
            <?php endforeach; ?>



        </section>
    </section>

    <section class="divisor" id="divisor_down" ></section>

</section>

<a id="com_a_gente" ></a>
<section id="section_global_04" style="height:auto; " >
<section style="width:auto; height:auto; margin-left:0%; padding-bottom:50px; " >
<section id="section_04" >
<section id="clientes_section" class="content_04" style="" >
<header class="header_title" id="header_section_04" >Clientes Atuais</header>
<div class="div_space" style="padding-bottom:1px; " ></div>
    <?php foreach($array_clientes_atuais as $cliente_atual): ?>
        <section>
            <a target="_blank" href="<?php echo $cliente_atual['link'] ?>">
            <figure class="figure_cliente" style="background-image:url('<?php echo $cliente_atual['logo'] ?>'); " >

            </figure>
            </a>
        </section>
    <?php endforeach; ?>

<div class="div_space" style="height:50px; " ></div>

<header class="header_title" id="header_section_04" >Clientes antigos</header>
<div class="div_space" style="padding-bottom:1px; " ></div>
    <?php foreach($array_clientes_antigos as $cliente_antigo): ?>
    <section>
        <a target="_blank" href="<?php echo $cliente_antigo['link'] ?>">
        <figure class="figure_cliente" style="background-image:url('<?php echo $cliente_antigo['logo'] ?>'); " >

        </figure>
        </a>
    </section>
    <?php endforeach; ?>



<div class="div_space" style="height:150px; " ></div>
</section>
<section id="parceiros_section" class="content_04" style="" >
<header class="header_title" id="header_section_04" >Parceiros</header>
<div class="div_space" style="padding-bottom:1px; " ></div>
    <?php foreach($array_parceiros as $parceiro): ?>
    <section>
        <a target="_blank" href="<?php echo $parceiro['link'] ?>">
        <figure class="figure_cliente" style="background-image:url('<?php echo $parceiro['logo'] ?>'); " >

        </figure>
        </a>
    </section>
    <?php endforeach; ?>

</section>
</section>
</section>
<section class="divisor" id="divisor_down" style="z-index:1; " ></section>
</section>

<a id="almanaque" ></a>

<section id="section_global_05" style="float:none; position:relative; margin-left:auto; margin-right:auto; display:block; height:auto; " >
    <section id="section_05" style="height:600px; padding-top:100px; " >
        <section style="position: relative;top: 30px;width:450px; height:auto; display:block; padding-right:50px; padding-bottom:15px; padding-left:50px; z-index:0; margin-left:auto; margin-right:auto; position:relative; float:none; " >

            <header class="header_title" id="header_section_05" style="position:relative; float:none; margin-left:auto; margin-right:auto; display:block; " >Nosso orgulho</header>

            <div class="line" id="line_section_05" ></div>
            <article id="article_slice_05" >
                <?php echo $array_296_almanaque_processoseletivo['almanaque_descricao']; ?>
            </article>
        </section>
        <section id="bg_almanaque_section" style="background-image:url(images/almanaque/bg_text.png);" ></section>
    </section>
    <section class="divisor" id="divisor_down" ></section>
</section>

<a id="processo_seletivo" ></a>
<section id="section_global_06" style="float:none; position:relative; margin-left:auto; margin-right:auto; display:block; " >
    <section id="section_06" style="" >
        <section id="content_06_section" style="" >
            <hgroup>
                <header class="header_title" id="header_section_06" >Como Entrar</header>
                <div class="line" id="line_section_06" ></div>
            </hgroup>

            <article id="article_slice_06" >
                <?php echo $array_296_almanaque_processoseletivo['processo_seletivo_descricao']; ?>
            </article>
        </section>
    </section>
    <section class="divisor" id="divisor_down" ></section>
</section>


<footer class="footer" >
    <section>
        <a href="#" target="" ><figure id="footer_image_logo" ></figure></a>

        <aside style="width:auto; height:auto; float:right; margin-top:50px; margin-right:2%; " >
            <address style="font-family:unb_officeregular; color:#FFFFFF; text-align:right; font-style:normal; font-size:10pt; line-height:1.3em; " >
                Universidade de Brasília, Campus Darcy Ribeiro, ICC<br>
                Norte, Faculdade de Comunicação, Bloco A, Sala<br>
                AT-626, Porta Verde. CEP: 79910-900<br>
                contato@doisnovemeia.com.br<br>
                55 (61) 3307 1793<br>
                <div style="color:#70B048; margin-top:8px; margin-bottom:8px; " >Nosso expediente é de segunda à sexta, das 14h às 18h.<br></div>
            </address>
            <section id="section_social" >
                <a href="http://doisnovemeia.com.br/blog/" target="_blank" ><div class="social" id="social_wordpress" ></div></a>
                <a href="http://www.facebook.com/Doisnovemeia" target="_blank" ><div class="social" id="social_facebook" ></div></a>
                <a href="http://twitter.com/Doisnovemeia" target="_blank" ><div class="social" id="social_twitter" ></div></a>
            </section>
        </aside>

    </section>
</footer>
<a id="contato" ></a>

</section></body></html>