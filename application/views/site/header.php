<?php
   $get_url = "index.php/site/produto";
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
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

        
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->


        <!-- Navigation & Logo-->
        <div class="mainmenu-wrapper">
            <div class="container">
                <div class="menuextras">
                    <div class="extras">
                        <ul>
                            <li><a href="page-login.html"><b>Área Administrativa</b></a></li>
                        </ul>
                    </div>
                </div>
                <!--                <nav id="mainmenu" class="mainmenu">
                                    <ul>
                                        <li class="logo-wrapper"><a href="index.html"><img src="img/logo2.png" alt="Aluminium Center"></a></li>
                                        <li class="active"><a href="index.html">Home</a></li>
                                        <li><a href="features.html">Sobre</a></li>
                                        <li><a href="features.html">Serviços</a></li>
                                        <li><a href="features.html">Equipe</a></li>
                                        <li><a href="features.html">Catálago</a></li>
                                        <li><a href="features.html">Produtos</a></li>
                                        <li><a href="features.html">Contato</a></li>
                                    </ul>
                                    <div class="mainmenu-submenu-inner">
                                        
                                    </div>
                                </nav>-->

                <nav id="mainmenu" class="mainmenu">
                    <ul>
                        <li class="logo-wrapper"><a href="index.html"><img src="<?php echo base_url() . '/img/logo2.png' ?>" alt="Multipurpose Twitter Bootstrap Template"></a></li>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>" >Home</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . "index.php/site/sobre" ; ?>">Sobre</a>
                        </li>
                        <li class="has-submenu">
                            <a href="#">Catálago + </a>
                            <div class="mainmenu-submenu">
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
//                                                   echo $produto->nome;
//                                                   echo "</a>";
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

//                                       a href='" . base_url() . $get_url . "/?pro_codigo=
                                    ?>
                                </div><!--/mainmenu-submenu-inner -->
                            </div><!--/mainmenu-submenu -->
                        </li>
                        <li >
                            <a href = "credits.html">Serviços</a>
                        </li>
                        <li><a href = "features.html">Equipe</a></li>
                        <li><a href = "features.html">Produtos</a></li>
                        <li><a href="<?php echo base_url() . "index.php/site/contato" ; ?>">Contato</a></li>
                    </ul>
                </nav>
            </div>
        </div>