<div class="container">    
    <div class="row">
        <div class="col-md-3">
                <div id="page-sidebar" class="sidebar">
                     <aside>
                         <header><h2>Oferta Educativa</h2></header>
                         <ul class="list-group list-unstyled">
                              {{ navigation:links group="oferta-educativa"   }}
                        </ul>
                         
                     
                   </aside>
                   
               </div>
        </div>
        <div class="col-md-9">
                <div id="page-main">
                    <section class="course-listing" id="courses">
                        <header><h2>Centros educativos</h2></header>
                       
                        <section id="course-list">
                            <div class="table-responsive">
                                <table class="table table-hover course-list-table tablesorter">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Municipio</th>
                                        
                                        <th>Clave</th>
                                        <th class="starts"></th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($centros as $centro){?>
                                        <tr>
                                            <th class="course-title"><?=$centro->nombre?></th>
                                            <th class="course-category"><?=$centro->municipio?></th>
                                            <th class="course-category"><?=$centro->clave?></th>
                                            <th><a href="<?=base_url('centros/detalles/'.$centro->id)?>">Visitar</a></th>
                                            
                                        </tr>
                                       <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </section><!-- /.course-listing -->
                    
                </div><!-- /#page-main -->
            </div><!-- /.col-md-8 -->
            
    </div>
</div>