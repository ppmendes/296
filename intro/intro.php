<?php
$base_url = "/var/www/296";
include($base_url."/login/seguranca.php");

mysql_query("SET NAMES utf8");
$sql = "SELECT * from `introducao_verbo` ORDER BY nome_verbo ASC ";
$resultado = mysql_query($sql);

$lista = '';
$i=0;

while ($verbo_introducao = mysql_fetch_array($resultado)){
    if($i==0){
		$lista .= "<li class=\"invisivel\">{$verbo_introducao['nome_verbo']}</li>";
		$selecionado = $verbo_introducao['nome_verbo'];
	}
    else{
        $lista .= "<li>{$verbo_introducao['nome_verbo']}</li>";
    }
    $i++;
}

?>
<!DOCTYPE html>
<html lang="pt-BR" class="no-js" ><!--<![endif]--><head style="" >

		<title>Intro v0.1 | Agência 296</title>

		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<meta name="author" content="Betafunda:Web" >
		<meta name="description" content="Agência Junior de Publicidade 296 Publicidade" >
		<meta name="keywords" content="Publicidade, Universidade, Junior, Agência, 296, doisnovemeia, UnB, Univerdidade, Brasília" >

		<!--<script type="text/javascript" src="http://sawpf.com/1.0.js" ></script>-->

		<link href="intro.css" rel="stylesheet" media="screen" type="text/css" >
		<link href="../fonts/stylesheet.css" rel="stylesheet" media="screen" type="text/css" >

		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" >
		
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" >
		<link rel="apple-touch-icon" href="apple-touch-icon.png" >

        <script type="text/javascript" src="../js/jquery.min.js" ></script>
    <script>
        var i = 0;
        $('document').ready(function(){

            $('.envelope').click(function(){
                if(i % 2 == 0){
                    $("ul").css('display','block');
                } else{
                    $("ul").css('display','none');
                }
                i++;
            });
            $('li').click(function(){
                $('.select').html($(this).html());
                $('.invisivel').removeClass('invisivel');
                $(this).addClass('invisivel');
                $("ul").css('display','none');
                i++;
            });
            $('#botao_ok').click(function(){
                verbo_selecionado = $('.select').html();
                window.location.href = 'verbos.php?verbo='+verbo_selecionado;
            });
        });

    </script>
    <style>
        ul{
            list-style-type: none;
            margin: 10px 0 0 0;
            padding: 0;
            width: 350px;
            text-align: center;
            border:solid 1px #000;
            border-radius: 5px;
            background-color: rgba(100, 100, 100, 0.2);
        }
        div.envelope,
        div.select,
        div.botao_seta{
            height: 40px;

        }
        div.envelope{
            width: 350px;
            border-bottom: solid 2px black;
            position: relative;
            overflow: hidden;
        }
        div.envelope:hover{
            cursor: pointer;
        }
        div.select{
            position: absolute;
            width: 330px;
            background: transparent;
            border: none;
            text-align: center;
            color: #4DB848;
            font-size: 3em;
        }
        div.botao_seta{
            width: 30px;
            position: absolute;
            right: 5px;
            background-image: url('../images/icon_down.png');
            background-position: right;
            background-repeat: no-repeat;
            background-size: 30%;
        }
        .invisivel{
            display: none;
        }
        li:hover{
            background-color: #AAAAAA;
            cursor: pointer;
        }
        .select_lista{
            margin-left: 20px;
            height: 44px;
            position:absolute;
            width:auto;
            top:40%;
            background-color:transparent;
            text-align:center;
            font-size:1em;
            min-width:220px;
            color: #000;
        }
        #botao_ok{
            width: 40px;
            font-size: 0.2em;
            float: right;
            background-color: #000;
            color: #FFF;
            text-align: center;
        }
        #botao_ok:hover{
            cursor: pointer;
        }
    </style>

	</head>
	<body style="background-image:url(../images/bg/pattern1.jpg); height:100%; overflow:hidden; margin:0; " >
    <figure style="position:absolute; bottom: 0; right: 0; width:160px; height:50px; margin-right:2%; background-color:transparent; margin-top:0; background-image:url(../images/296_2010.png); background-position:50% 0%; background-position-x:50%; background-position-y:0%; background-size:auto 100%; background-repeat-x:no-repeat; background-repeat-y:no-repeat; background-repeat:no-repeat; " ></figure>
		<section id="main" style="height:100%; " >
			<hgroup style="background-color:transparent; height:50px; font-family:'UnB Pro', Helvetica; text-shadow:rgb(255, 255, 255) 1px 2px 3px; font-size:1.2em; " ><a href="../index.php" target="" name="" ><nav style="position:relative; float:right; width:auto; margin-right:2%; background-color:transparent; text-align:center; text-transform:uppercase; font-family:inherit; padding-top:1%; color: #000; font-size: 0.5em; " >Pular</nav></a></hgroup>
			<section id="content" style="width:100%; min-width:800px; height:600px; min-height:500px; " ><section style="position:relative; float:none; margin-left:auto; margin-right:auto; display:block; min-width:600px; height:600px; font-family:'UnB Pro', Helvetica; line-height:2em; text-shadow:rgba(0, 0, 0, 0.496094) 0px 0px 2px; text-rendering:geometricprecision; font-weight:normal; font-style:normal; color:#4DB848; width:900px; " ><section style="position:relative; background-color:transparent; float:left; display:block; width:160px; height:100%; " >
                <article style="color: #000; height:44px; position:absolute; width:100%; top:40%; background-color:transparent; text-align:right; font-size:3em; " >Nós</article>
            </section>
            <section style="position:relative; background-color:transparent; float:left; display:block; width:380px; height:100%; padding-right:5px; padding-left:5px; " >
                <div class="select_lista">
                    <div class="envelope">
                        <div class="select"><?php echo $selecionado; ?></div><div class="botao_seta">&nbsp;</div>
                    </div>
                    <ul class="invisivel">
                        <?php echo $lista; ?>
                    </ul>
                </div>
                <!-- <article style="height:44px; position:absolute; width:auto; top:40%; background-color:transparent; text-align:center; font-size:3em; min-width:220px; border-bottom:2px solid #000000; " >amamos</article> -->
            </section>
                <section style="position:relative; background-color:transparent; float:left; display:block; width:330px; height:100%; clear:right; min-width:300px; " ><article style="color: #000; height:44px; position:absolute; top:40%; background-color:transparent; text-align:left; font-size:3em; padding-left:0px; width:320px; " >publicidade.<div id="botao_ok">OK</div></article>
            </section></section></section>
			<footer style="height:50px; background-color:transparent; margin-bottom:1%; " >
                </footer>
		</section><br></body></html>
