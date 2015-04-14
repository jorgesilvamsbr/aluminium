
<!-- PARA UTILIZAR O ELEVATE ZOOM -->
<script src="<?php echo base_url() . 'js/elevatezoom/jquery-1.8.3.min.js' ?>"></script>
<script src="<?php echo base_url() . 'js/elevatezoom/jquery.elevatezoom.js' ?>"></script>
<?php
   foreach ($itemQuery->result() as $it) {
       $item = $it;
   }
?>
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1><?php echo $item->nome ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <?php
           //pega o item certo


           $counter = 1;

           foreach ($imagemItem->result() as $img) {
               if ($counter == 1) {
                   echo "<div class='row'>";
                   echo "<div class='col-sm-6'>";
                   echo "<div class='portfolio-item'>";
                   echo "<div class='portfolio-image'>";
                   echo "<a href='#'><img id='zoom_0" . $counter . "' src='" . base_url() . "img/" . $id_categoria . "/" . $id_produto . "/" . $item->id . "/" . $img->nome . "' data-zoom-image='" . base_url() . "img/" . $id_categoria . "/" . $id_produto . "/" . $item->id . "/" . $img->nome . "' alt='Project Name'></a>";
                   echo "</div>";
                   echo "</div>";
                   echo "</div>";
                   echo "<div class='portfolio-item-description col-sm-6'>";
                   echo "<h3>" . $item->nome . "</h3>";
                   echo "<p>";
                   echo $item->descricao;
                   echo "</p>";
                   echo "<p>";
//                   echo "Etiam aliquet tempor est nec pharetra. Etiam interdum tincidunt orci vitae elementum. Donec sollicitudin quis risus sit amet lobortis. Fusce sed tincidunt nisl.";
                   echo "</p>";
                   echo "<ul class='no-list-style'>";
//                   echo "<li><b>Client:</b> Some Client LTD</li>";
//                   echo "<li><b>Date:</b> 01, September 2012 - 23, February 2013</li>";
//                   echo "<li><b>Technologies:</b> HTML5, CSS3, jQuery, PHP, MySQL</li>";
                   echo "<li class='portfolio-visit-btn'><a href='#' class='btn'>Fazer Orçamento</a></li>";
                   echo "</ul>";
                   echo "</div>";
                   echo "</div>";

                   echo "<h3>Detalhes</h3>";
                   echo "<div class='row'>";
               } else {
                   echo "<div class='col-md-4 col-sm-6'>";
                   echo "<div class='portfolio-item'>";
                   echo "<div class='portfolio-image'>";
                   echo "<a href='#'><img id='zoom_0" . $counter . "' src='" . base_url() . "img/" . $id_categoria . "/" . $id_produto . "/" . $item->id . "/" . $img->nome . "' data-zoom-image='" . base_url() . "img/" . $id_categoria . "/" . $id_produto . "/" . $item->id . "/" . $img->nome . "' alt='Project Name'></a>";
//                   echo "<a href='#'><img src='" . base_url() . "img/" . $id_categoria . "/" . $id_produto . "/" . $item->id . "/" . $img->nome . "' alt='Project Name'></a>";
                   echo "</div>";
                   echo "<div class='portfolio-info-fade'>";
                   echo "<ul>";
                   echo "<li class='portfolio-project-name'>Project Name</li>";
                   echo "<li>Website design & Development</li>";
                   echo "<li>Client: Some Client LTD</li>";
                   echo "<li class='read-more'><a href='#' class='btn'>Read more</a></li>";
                   echo "</ul>";
                   echo "</div>";
                   echo "</div>";
                   echo "</div>";
               }

               if ($counter == 4)
                   break;

               $counter++;
           }
           if ($counter >= 2)
               echo "</div>"; //fechar <div class='row'>
        ?>
    </div>
</div>
<script>

//             $("#zoom_01").elevateZoom();
    $("#zoom_01").elevateZoom({tint: true, tintColour: '#F90', tintOpacity: 0.5});
//             $("#zoom_02").elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5});
//    $("#zoom_03").elevateZoom({tint: true, tintColour: '#F90', tintOpacity: 0.5});
//    $("#zoom_04").elevateZoom({tint: true, tintColour: '#F90', tintOpacity: 0.5});

    $('#zoom_02').elevateZoom({
//                zoomType: "inner",
//                cursor: "crosshair",
        zoomWindowWidth: 400,
        zoomWindowHeight: 300,
//                zoomWindowFadeIn: 500,
//                zoomWindowFadeOut: 750,
        zoomWindowPosition: 16,
    });
    $("#zoom_03").elevateZoom({
  zoomType				: "inner",
  cursor: "crosshair"
});
    $("#zoom_04").elevateZoom({
        zoomType: "lens",
        lensShape: "round",
        lensSize: 250
    });
</script>
</body>
</html>