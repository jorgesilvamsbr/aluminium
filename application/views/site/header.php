<?php
   $get_url = "index.php/site/produto";
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="ISO-8859-1">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>.:: ALUMINIUM CENTER ::.</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
        <link rel="stylesheet" href="<?php echo base_url() . '/css/icomoon-social.css' ?>">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="<?php echo base_url() . '/css/leaflet.css' ?>" />
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/leaflet.ie.css" />
        <![endif]-->
        <link rel="stylesheet" href="<?php echo base_url() . '/css/main-red.css' ?>">

        <script src="<?php echo base_url() . '/js/modernizr-2.6.2-respond-1.1.0.min.js' ?>"></script>

         <style type="text/css"> 
  	        @media screen and (min-width: 924px) {
 		        li#logowrapper { 
 					position: absolute; 
 					top: 8%; 
 					left: 1%; 
 					z-index: 998; 
 				} 
  			} 
         </style>
        
    </head>
    <body>

        <!-- Navigation & Logo-->
        <div class="mainmenu-wrapper">
            <div class="container">
                <div class="menuextras">
                    <div class="extras">
                        <ul>
                            <li><a href="<?php echo base_url() . "index.php/admin" ; ?>"><b>Área Administrativa</b></a></li>
                        </ul>
                    </div>
                </div>
                <nav id="mainmenu" class="mainmenu">
                    <ul>
                        <li id="logowrapper" class="logo-wrapper"><img src="<?php echo base_url() . '/img/logo3.png' ?>" alt="Multipurpose Twitter Bootstrap Template"></li>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>" >Início</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . "index.php/site/sobre" ; ?>">Sobre</a>
                        </li>
                        <li class="has-submenu">
                            <a href="#">Catálago + </a>
                            <div id="mainmenusubmenu" class="mainmenu-submenu">
                                <div class="mainmenu-submenu-inner"> 

                                    <?php
                                       $counter = 0;
                                       foreach ($categorias->result() as $categoria) {
                                           if ($counter == 0) {
                                               echo "<div>";
                                           }
                                           echo "<h4>";
                                           echo $categoria->nome;
                                           echo "</h4>";
                                           echo "<ul>";

                                           foreach ($produtos->result() as $produto) {
                                               if ($produto->id_categoria == $categoria->id) {
                                                   echo "<li>";
                                                   echo "<a href='#'>";
                                                   echo "<a href='" . base_url() . $get_url . "/?id=" . $produto->id . "'>" . $produto->nome . "</a>";
                                                   echo "</li>";
                                               }
                                           }
                                           echo "</ul>";

                                           $counter++;

                                           if ($counter == 3) {
                                               echo "</div>";
                                               $counter = 0;
                                           }
                                       }

                                       if ($counter < 3 && $counter > 0)
                                           echo "</div>";
                                    ?>
                                </div><!--/mainmenu-submenu-inner -->
                            </div><!--/mainmenu-submenu -->
                        </li>
                        <li><a href="<?php echo base_url() . "index.php/site/contato" ; ?>">Contato</a></li>
                    </ul>
                </nav>
            </div>
        </div>
