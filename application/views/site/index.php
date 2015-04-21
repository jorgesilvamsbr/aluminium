<?php
$get_url = "index.php/site/item";        
?>
    <!--$( "#greatphoto" ).attr( "alt", "Beijing Brush Seller" );-->
<!-- Homepage Slider -->
        <div class="homepage-slider">
            <div id="sequence">
                <ul class="sequence-canvas">
                    <!-- Slide 1 -->
                    <li style="background-image: '../img/homepage-slider/slider-bg1.jpg' !important;">
                        <!-- Slide Title -->
                        <h2 class="title">Novidade</h2>
                        <!-- Slide Text -->
                        <h3 class="subtitle">Você pode colocar um texto descrevendo o o produto aqui!</h3>
                        <!-- Slide Image -->
                        <img class="slide-img" src="<?php echo base_url() . '/img/homepage-slider/slide1.png'?>" alt="Slide 1" />
                    </li>
                    <!-- End Slide 1 -->
                    <!-- Slide 2 -->
                    <li class="bg1">
                        <!-- Slide Title -->
                        <h2 class="title">Venha conferir!</h2>
                        <!-- Slide Text -->
                        <h3 class="subtitle">Cole aqui uma chamada para o seu produto!</h3>
                        <!-- Slide Image -->
                        <img class="slide-img" src="<?php echo base_url() . '/img/homepage-slider/slide1.png'?>" alt="Slide 2" />
                    </li>
                    <!-- End Slide 2 -->
                    <!-- Slide 3 -->
                    <li class="bg1">
                        <!-- Slide Title -->
                        <h2 class="title">Título Título</h2>
                        <!-- Slide Text -->
                        <h3 class="subtitle">Use a criatividade! Use a criatividade! Use a criatividade!</h3>
                        <!-- Slide Video -->
                    </li>
                    <!-- End Slide 3 -->
                </ul>
                <div class="sequence-pagination-wrapper">
                    <ul class="sequence-pagination">
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Homepage Slider -->

<!--        <div class="section section-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Conheça nossa história...</h3>
                        <p>
                            Funda em aqui você pode colocar um texto descrevendo sua empresa uma breve história para que o usuário possa saber qual a inspiração, valores e visão que a empresa trabalha.
                        </p>
                        <p>
                            Funda em aqui você pode colocar um texto descrevendo sua empresa uma breve história para que o usuário possa saber qual a inspiração, valores e visão que a empresa trabalha.
                            Funda em aqui você pode colocar um texto descrevendo sua empresa uma breve história para que o usuário possa saber qual a inspiração, valores e visão que a empresa trabalha.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="video-wrapper">
                            <iframe width="420" height="315" src="https://www.youtube.com/embed/78b05zBHX4s" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->

        <div class="section">
            <div class="container">
                <h2>Novidades</h2>
                <div class="row">
                    <?php
                    $count = 1;
                    foreach($itens->result() as $item)
                    {
                        
                        foreach($produtos->result() as $pro)
                        {
                            if($pro->id == $item->id_produto)
                            {
                                $id_produto = $pro->id;
                                $id_categoria = $pro->id_categoria;
                                break;
                            }
                        }
                        
                        foreach($imagens->result() as $img)
                        {
                            if($img->id_item == $item->id)
                            {
                                $img_nome = $img->nome;
                                break;
                            }
                        }
                        
                        
                            
                        echo "<div class='col-md-4 col-sm-6'>";
                        echo "<div class='portfolio-item'>";
                        echo "<div class='portfolio-image'>";
                        echo "<a href='" . base_url() . $get_url . "/?id=" . $item->id ."'><img src='" . base_url() . "img/portfolio/" . $id_categoria . "/" . $id_produto . "/" . $item->id . "/" . $img_nome . "'></a>";
                        echo "</div>";
                        echo "<div class='portfolio-info'>";
                        echo "<ul>";
                        echo "<li class='portfolio-project-name'>" . $item->nome . "</li>";
                        echo "<li>" . substr($item->descricao, 0, 40) . "...</li>";
//                        echo "<li>Cliente: Some Client LTD</li>";
                        echo "<li class='read-more'><a href='" . base_url() . $get_url . "/?id=" . $item->id ."' class='btn'>Veja mais</a></li>";
                        echo "</ul>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        if($count == 3)
                            break;
                        
                        $count++;
                    }
                    
                    ?>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
<!--        <div class="section">
            <div class="container">
                <h2>Clientes Satisfeitos</h2>
                <div class="row">
                     Testimonial 
                    <div class="testimonial col-md-4 col-sm-6">
                         Author Photo 
                        <div class="author-photo">
                            <img src="img/user1.jpg" alt="Author 1">
                        </div>
                        <div class="testimonial-bubble">
                            <blockquote>
                                 Quote 
                                <p class="quote">
                                    "Este texto é apenas um modelo de comentário de algum cliente feliz pelo trabalho realizado."
                                </p>
                                 Author Info 
                                <cite class="author-info">
                                    - Alberto Silva,<br>Diretora Geral da <a href="#">Compania Ficticia</a>
                                </cite>
                            </blockquote>
                            <div class="sprite arrow-speech-bubble"></div>
                        </div>
                    </div>
                     End Testimonial 
                    <div class="testimonial col-md-4 col-sm-6">
                        <div class="author-photo">
                            <img src="img/user5.jpg" alt="Author 2">
                        </div>
                        <div class="testimonial-bubble">
                            <blockquote>
                                <p class="quote">
                                    "Este texto é apenas um modelo de comentário de algum cliente feliz pelo trabalho realizado."
                                </p>
                                <cite class="author-info">
                                    - Nome Sobrenome,<br>Gerente da <a href="#">Sua Empresa</a>
                                </cite>
                            </blockquote>
                            <div class="sprite arrow-speech-bubble"></div>
                        </div>
                    </div>
                    <div class="testimonial col-md-4 col-sm-6">
                        <div class="author-photo">
                            <img src="img/user2.jpg" alt="Author 3">
                        </div>
                        <div class="testimonial-bubble">
                            <blockquote>
                                <p class="quote">
                                    "Este texto é apenas um modelo de comentário de algum cliente feliz pelo trabalho realizado."
                                </p>
                                <cite class="author-info">
                                    - Maria Antonieta,<br>Analista Geral da <a href="#">Empresa Fantasma</a>
                                </cite>
                            </blockquote>
                            <div class="sprite arrow-speech-bubble"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <!-- End Testimonials -->
    </body>
</html>
