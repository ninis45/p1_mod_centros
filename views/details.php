<div class="container">
     <header><h1><?=$centro->nombre?></h1></header>
     <div class="row">
        <div class="col-md-2">
                <figure class="course-image">
                    <?php if($centro->portada && $centro->portada!='dummy'){?>
                    <div class="image-wrapper"><img src="<?=base_url('files/cloud_thumb/'.$centro->portada.'/150/150')?>"></div>
                    <?php }else{?>
                        <?=Asset::img('no_image.png',true);?>
                    <?php }?>
                </figure>
        </div>
        <div class="col-md-10">
            <div id="page-main">
                <section id="course-detail">
                    <article class="course-detail">
                         <section id="course-header">
                                <header>
                                    <h2 class="course-date">Clave <?=$centro->clave?></h2>
                                    <div class="course-category"><?=$centro->domicilio?></div>
                                </header>
                                <hr/>
                                
                                <figure id="course-summary">
                                    <span class="course-summary" id="course-length"><i class="fa fa-phone"></i><?=$centro->telefono?></span>
                                    <span class="course-summary" id="course-time-amount"><i class="fa fa-envelope"></i><?=$centro->email?></span>
                                    <span class="course-summary" id="course-time-amount"><i class="fa fa-coffee"></i><?=ucfirst($centro->turno)?></span>
                                    
                                </figure><!-- /#course-summary -->
                            </section><!-- /#course-header -->
                            <section>
                                
                                    <?=$centro->descripcion?>
                                
                            </section>
                            <section>
                                <header><h2>Mapa</h2></header>
                                <div id="map" style="height: 300px; width:100%"></div>
                            </section>
                    
                    </article>
                </section>
            </div>
        </div>
        
     </div>

</div>