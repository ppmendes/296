<!DOCTYPE html>
<html>
<head>
    <title>Gerenciador de Conteúdo do Site 296</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <script type="text/javascript" src="../../js/jquery.min.js"></script>

    <!-- Load TinyMCE -->
    <script type="text/javascript" src="../jscripts/tiny_mce/jquery.tinymce.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('textarea.tinymce').tinymce({
                // Location of TinyMCE script
                script_url : '../jscripts/tiny_mce/tiny_mce.js',

                // General options
                theme : "advanced",
                plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

                // Theme options
                theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : true,

                // Example content CSS (should be your site CSS)
                content_css : "../css/content.css",

                // Drop lists for link/image/media/template dialogs
                template_external_list_url : "../lists/template_list.js",
                external_link_list_url : "../lists/link_list.js",
                external_image_list_url : "../lists/image_list.js",
                media_external_list_url : "../lists/media_list.js",

                // Replace values for the template plugin
                template_replace_values : {
                    username : "Some User",
                    staffid : "991234"
                }
            });

        });
    </script>
    <!-- /TinyMCE -->

    <!-- começo do fancybox -->
    <script type="text/javascript" src="../../js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="../../js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="../../js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />


    <!-- Add Thumbnail helper (this is optional) -->

    <!-- fim do fancybox -->
    <!-- Script de Inicialização do Fancybox -->
    <!-- Script de Finalização do Fancybox -->
    <link rel="stylesheet" type="text/css" href="../css/admin.css" />
</head>
<body>

<?php

/*
 * Garantindo que todas páginas de edição de conteúdo sejam acessadas somente por usuários logados
 */

$base_url = "C:/wamp/www/296";
include($base_url."/login/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
?>