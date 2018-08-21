<div class="alert alert-info">
<?php if ($this->method == 'create'): ?>
	<p><?php echo lang('planteles:create_title') ?></p>
<?php else: ?>
	<p><?php echo sprintf(lang('planteles:edit_title'), $plantel->nombre) ?></p>
<?php endif ?>
</div>
<section class="item">
	<div class="content" ng-controller="InputCtrl">
<?php echo form_open_multipart(uri_string(), ' id="page-form"  data-mode="'.$this->method.'"',array('id'=>$id)); ?>



	    <div class="ui-tab-container ui-tab-horizontal">
        
        
        	<uib-tabset justified="false" class="ui-tab">
        	        <uib-tab heading="Información General">
                        
                            <div class="form-group">
                    			<label for="nombre" class="control-label"><span>*</span> Nombre: </label>
                    			
                    				<?php echo form_input('nombre',$plantel->nombre,'id="nombre" class="form-control"');?>
                                	
                                
                    		</div>
                            <div class="form-group">
                    			<label for="clave" class="control-label"><span>*</span> Clave: </label>
                    			
                    				<?php echo form_input('clave',$plantel->clave,'id="clave" class="form-control"');?>
                                	
                                
                    		</div>
                           
                            <div class="form-group">
                    			<label for="descripcion" class="control-label"> Descripción: </label>
                    			<div class="input">
                    				<?php echo form_textarea('descripcion',$plantel->descripcion,'id="descripcion" class="form-control"');?>
                                	
                                </div>
                    		</div>
                             
                           
                             <div class="form-group">
                    			<label for="telefono" class="control-label"><span>*</span> Telefono: </label>
                    			<div class="input">
                    				<?php echo form_input('telefono',$plantel->telefono,'id="telefono" class="form-control"');?>
                                	
                                </div>
                    		</div>
                            <div class="form-group">
                    			<label for="email" class="control-label"><span>*</span> Correo electrónico: </label>
                    			<div class="input">
                    				<?php echo form_input('email',$plantel->email,'id="email" class="form-control"');?>
                                	
                                </div>
                    		</div>
                            <div class="form-group">
                    			<label for="fecha_creacion" class="control-label"><span>*</span> Fecha de creacion: </label>
                    			<div class="input-group ui-datepicker">
                                    
                    				<?php echo form_input('fecha_creacion',$plantel->fecha_creacion,'id="date" class="form-control" uib-datepicker-popup="yyyy-MM-dd" 
                                       ng-init="fecha_creacion=\''.$plantel->fecha_creacion.'\'"
                                       ng-model="fecha_creacion"
                                       is-open="status.fecha_creacion" 
                                       
                                       datepicker-options="dateOptions" 
                                       date-disabled="disabled(date, mode)" 
                                       
                                       close-text="Cerrar"');?>
                                      <span class="input-group-addon" ng-click="status.fecha_creacion=true;"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                    		</div>
                            <div class="form-group">
                    			<label for="tipo" class="control-label"><span>*</span> Tipo: </label>
                    			<div class="input">
                    				<?php echo form_dropdown('tipo',array('EMSaD'=>'EMSaD','Plantel'=>'Plantel'),$plantel->tipo,'id="tipo" class="form-control"');?>
                                	
                                </div>
                    		</div>
                            <div class="form-group">
                    			<label for="turno" class="control-label"><span>*</span> Turno: </label>
                    			<div class="input">
                    				<?php echo form_dropdown('turno',array('matutino'=>'Matutino','vespertino'=>'Vespertino'),$plantel->turno,'id="turno" class="form-control"');?>
                                	
                                </div>
                    		</div>
                        
                     </uib-tab>
                     <uib-tab heading="Ubicación"  >
                        <div class="form-group">
                			<label for="municipio" class="control-label"><span>*</span> Municipio: </label>
                			<div class="input">
                				<?php echo form_dropdown('municipio',$municipios,$plantel->municipio,'id="municipio" class="form-control"');?>
                            	
                            </div>
                		</div>
                        <div class="form-group">
                			<label for="localidad" class="control-label"><span>*</span> Localidad: </label>
                			<div class="input">
                				<?php echo form_input('localidad',$plantel->localidad,'id="localidad" class="form-control"');?>
                            	
                            </div>
                		</div>
                        <div class="form-group">
                			<label for="domicilio" class="control-label"><span>*</span> Domicilio: </label>
                			<div class="input">
                				<?php echo form_textarea('domicilio',$plantel->domicilio,'id="domicilio" class="form-control"');?>
                            	
                            </div>
                		</div>
                        <div class="form-group row">
                            <label for="domicilio" class="control-label col-sm-2"><span>*</span> Mapa: </label>
                            <div class="col-sm-2">
                                
                                <?php echo form_input('latitud',$plantel->latitud,'id="lat" placeholder="Latitud" class="form-control" ');?>
                                <?php echo form_input('longitud',$plantel->longitud,'id="lon" placeholder="Longitud" class="form-control" ');?>
                                <?php echo form_input('zoom',$plantel->zoom,'id="zoom" placeholder="Zoom" class="form-control" ' );?>
                                <div class="divider"></div>
                                <a href="#" id="btn-load-map" class="btn btn-primary">Cargar datos</a>
                            </div>
                            
                            <div id="map" class="col-sm-6" style="height: 400px;">
                            
                            
                            </div>
                            
                           
                        </div>
                        <div ng-controller="MapCtrl"> 
                             <map class="ui-map" zoom="11" center="[40.74, -74.18]" scrollwheel="false">
                                <marker position="[40.72, -74.20]" title="marker" animation="Animation.DROP"></marker>
                                <marker position="[40.73, -74.19]" on-click="show-info()" title="drag me" draggable="true"></marker>
                            </map>
                         </div>   
                        <div class="clearfix"></div>
                     </uib-tab>
                     
                     
                     <?php if ($stream_fields): ?>
                        <uib-tab heading="<?php echo lang('global:custom_fields') ?>">
                        <?php foreach ($stream_fields as $field) echo $this->load->view('admin/partials/streams/form_single_display', array('field' => $field), true) ?>
                        </uib-tab>
                     <?php endif; ?>
                     
                      <uib-tab heading="Usuarios">
                           
                            <?php foreach($usuarios as $usuario):?>
                                <label class="checkbox-inline">
                                    <?=form_checkbox('users[]',$usuario->id,in_array($usuario->id,is_array($plantel->users)?$plantel->users:array()));?>
                                    <?=$usuario->display_name?>
                                    <span class="help-block"><?=$usuario->description?></span>
                                    
                                </label>
                            <?php endforeach;?>
                           
                      </uib-tab>
           </uib-tabset>
        </div>
        <md-tabs md-selected="selectedIndex">
  <img ng-src="img/angular.png" class="centered">
  <md-tab ng-repeat="tab in tabs | orderBy:predicate:reversed" md-on-select="onTabSelected(tab)" md-on-deselect="announceDeselected(tab)" ng-disabled="tab.disabled">
    <md-tab-label>
      {{tab.title}}
      <img src="img/removeTab.png" ng-click="removeTab(tab)" class="delete">
    </md-tab-label>
    <md-tab-body>
      {{tab.content}}
    </md-tab-body>
  </md-tab>
</md-tabs>
		
    
    
		
  
        
   


    	
   
    <div class="divider"></div>
   <div class="buttons">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>
  </div>
<?php echo form_close();?>
	</div>
</section>

