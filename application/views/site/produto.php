<?php
   $get_url_item = "index.php/site/item";
?>        
<!-- Page Title -->
		<div class="section section-breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>
                                                <?php foreach($produto->result() as $pro)
                                                {
                                                    echo $pro->nome; //Imprime nome do Produto
                                                    $id_produto = $pro->id;
                                                    $id_categoria = $pro->id_categoria;
                                                }
                                                ?></h1>
					</div>
				</div>
			</div>
		</div>
        
        <div class="section">
	    	<div class="container">
				<div class="row">
                                    <?php
                                    
                                    foreach($itens->result() as $item)
                                    {
                                        echo "<div class='col-sm-6'>";
                                        echo "<div class='portfolio-item'>";
                                        echo "<div class='portfolio-image'>";
                                        
                                        foreach($imagemItem->result() as $img)
                                        {
                                            if($img->id_item == $item->id)
                                            {
                                                $img_nome = $img->nome;
                                                break;
                                            }
                                        }
                                        
                                        echo "<a href='page-portfolio-item.html'><img src='" . base_url() . "img/" . $id_categoria . "/" . $id_produto . "/" . $item->id . "/" . $img_nome ."' alt='Project Name'></a>";
                                        echo "</div>";
                                        echo "<div class='portfolio-info-fade'>";
                                        echo "<ul>";
                                        echo "<li class='portfolio-project-name'>" . $item->nome . "</li>";
                                        echo "<li>" . $item->descricao . "</li>";
//                                        echo "<li>Client: Some Client LTD</li>";
                                        echo "<li class='read-more'><a href='" . base_url() . $get_url_item . "/?id=" . $item->id . "' class='btn'>Ver Mais...</a></li>";
                                        echo "</ul>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                       
                                    ?>
				</div>
			</div>
		</div>
        
    </body>
</html>