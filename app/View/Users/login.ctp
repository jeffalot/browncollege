<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    <p>To login via Netbadge, click <a href="/brown/netbadge">here</a>.</p>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>