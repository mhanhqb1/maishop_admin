<div class="form-box" id="login-box">
    <?php echo $this->Flash->render() ?>
    <?php echo $this->Html->image('logo.png'); ?>
    <br />
    <div class="header"><?php echo __('LABEL_LOGIN') ?></div>

    <div class="body bg-gray">
        <?php 
            echo $this->SimpleForm->render($loginForm); 
        ?>
    </div>
</div>
