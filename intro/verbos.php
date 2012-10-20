<!DOCTYPE html>
<html lang="pt-BR" class="no-js" ><!--<![endif]--><head style="" >

		<title>Intro v0.1 | Agência 296</title>

		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<meta name="author" content="Betafunda:Web" >
		<meta name="description" content="Agência Junior de Publicidade 296 Publicidade" >
		<meta name="keywords" content="Publicidade, Universidade, Junior, Agência, 296, doisnovemeia, UnB, Univerdidade, Brasília" >

		<!--<script type="text/javascript" src="http://sawpf.com/1.0.js" ></script>-->

		<link href="../fonts/stylesheet.css" rel="stylesheet" media="screen" type="text/css" >

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" >
		
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" >
		<link rel="apple-touch-icon" href="apple-touch-icon.png" >

        <script type="text/javascript" src="../js/jquery.min.js" ></script>
        <script>
            var i =0;
            $('document').ready(function(){
                $('.botao_mostra').click(function(){
                    if(i % 2 == 0){
                        $('figcaption').removeClass('invisivel');
                        $('.botao_mostra').addClass('botao_fecha');
                    }else{
                        $('figcaption').addClass('invisivel');
                        $('.botao_mostra').removeClass('botao_fecha');
                    }
                    i++;
                });
            });

        </script>
    <style>
        .invisivel{
            display: none;
        }
        body{
            font-family: 'UnB Pro',Helvetica;
            font-style: normal;
            font-weight: normal;
            line-height: 2em;
            text-rendering: geometricprecision;
            text-shadow: 0 0 2px rgba(0, 0, 0, 0.498);
        }
        .botao_mostra{
            position: absolute;
            left: 50%;
            width: 50px;
            height: 50px;
            margin-left: -25px;
            background-color: rgba(0,0,0,0.76);
            background-image: url('../images/Seta.png');
            background-repeat: no-repeat;
            background-position: center;
            z-index: 2;
            cursor: pointer;
        }
        .botao_fecha{
            position: absolute;
            left: 50%;
            width: 50px;
            height: 50px;
            margin-left: -25px;
            background-color: rgba(0,0,0,0.76);
            background-image: url('../images/Seta2.png');
            background-repeat: no-repeat;
            background-position: center;
            z-index: 2;
        }

        figcaption{
            position: absolute;
            left: 50%;
            width: 500px;
            margin-left: -250px;
            background-color: rgba(0,0,0,0.76);
            z-index: 1;
            padding: 50px 20px 10px 20px;
        }
        figcaption td{
            color: #4DB848;
            padding-right: 20px;
        }
        nav{
            margin-top: 10px;
            margin-left: 2%;
        }
        nav a{
            color: #4DB848;
            text-decoration: none;
            margin-right: 10px;
        }
        footer div{
            margin-top: 10px;
        }
    </style>

	</head>
	<body style="overflow: hidden; height: 100%; margin: 0; padding: 0;">

		<section id="main" style="overflow: hidden; height: 100%;" >
            <figure style="overflow: hidden; height: 100%; margin: 0; padding: 0;">
                <?php
                    $verbo = $_REQUEST['verbo'];
                    $imagem = '';
                    if($verbo == 'amamos'){
                        $imagem = 'Amar';
                    } else if($verbo == 'devoramos'){
                        $imagem = 'Devorar';
                    }else if($verbo == 'dormimos'){
                        $imagem = 'Dormir';
                    }else if($verbo == 'espirramos'){
                        $imagem = 'Espirrar';
                    }
                ?>
                <div class="botao_mostra">
                    &nbsp;
                </div>
                <figcaption class="invisivel">
                    <table>
                        <tr>
                            <td>Diretor de Arte: Luciano Franco</td>
                            <td>Redator: Pedro Mendes</td>

                        </tr>
                        <tr>
                            <td>Fotografia: Luciano Franco</td>
                            <td>Sei lá o que: Pedro Mendes</td>
                        </tr>
                    </table>
                </figcaption>
                <img src="../images/verbos/<?php echo $imagem; ?>.jpg" alt="" width="100%" />
            </figure>
		</section>
        <footer style="padding: 10px 0; position:absolute; bottom: 0; width: 100%; height:50px; background-color: #FFF;" >
            <nav style=" float: left;"><a href="intro.php">VOLTAR</a> <a href="../index.php">SEGUIR</a></nav>
            <figure style=" float: right; width:160px; height:50px; margin-right:2%; background-color:transparent; margin-top:0; background-image:url(../images/296_2010.png); background-position:50% 0%; background-position-x:50%; background-position-y:0%; background-size:auto 100%; background-repeat-x:no-repeat; background-repeat-y:no-repeat; background-repeat:no-repeat; " ></figure>
            <div style=" float: right;">Vivemos publicidade.</div>
        </footer>
    </body>
</html>
