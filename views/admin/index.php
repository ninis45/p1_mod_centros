<section class="title">
	<h4><?php echo $module_details['name'] ?></h4>
</section>

<section class="item">
	<div class="content">
		<?php if ($items): ?>
			<table class="table table-list" cellspacing="0">
				<thead>
					<tr>
						<th width="40%">Nombre</th>
                        
						<th>Clave</th>
                        <th>Correo electrónico</th>
						<th width="14%"></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="5">
							<div class="inner"><?php $this->load->view('admin/partials/pagination') ?></div>
						</td>
					</tr>
				</tfoot>
				<tbody>
                    <?php foreach($items as $row){?>
                        <tr>
						  <td>
                          
                                
                          
                               <?php echo $row->nombre ?>
                          </td>
                          
						  <td><?php echo $row->clave ?></td>
                          <td><?php echo $row->email ?></td>
                          <td class="actions">
                            <?php echo anchor('admin/centros/edit/'.$row->id, lang('buttons:edit'), 'class="button edit"') ?> |
                           
			                 <?php echo anchor('admin/centros/delete/'.$row->id, lang('buttons:delete'), 'confirm-action  class="button delete"') ?>
                           
                          
                          </td>
                        </tr>
                    <?php }?>
                </tbody>
          </table>
   	     <?php else: ?>
			<section class="no_data">
				<?php echo lang('global:not_found');?>
			</section>
		<?php endif;?>
    </div>
 </section>