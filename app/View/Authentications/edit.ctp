<div class="authentications form">
<?php echo $this->Form->create('Authentication'); ?>
	<fieldset>
		<legend><?php echo __('Edit Authentication'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('ipaddr');
		echo $this->Form->input('value');
		echo $this->Form->input('valid');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Authentication.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Authentication.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Authentications'), array('action' => 'index')); ?></li>
	</ul>
</div>
