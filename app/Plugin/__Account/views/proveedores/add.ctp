     <?php  
        echo $this->element('menuadmin');
     ?>
<div class="proveedores form">
<?php echo $this->Form->create('Proveedor');?>
	<fieldset>
 		<legend><?php __('Nuevo Proveedor');?></legend>
	<?php
		echo $this->Form->input('name', array('label'=>'Nombre'));
		echo $this->Form->input('cuit');
		echo $this->Form->input('mail');
		echo $this->Form->input('telefono');
		echo $this->Form->input('domicilio');
	?>
<?php echo $this->Form->end('Guardar');?>
</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar Proveedores', true), array('action' => 'index'));?></li>
	</ul>
</div>
