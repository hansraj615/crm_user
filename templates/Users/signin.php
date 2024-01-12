
<?= $this->Form->create() ?>
    <?= $this->Form->input('email', ['label' => 'Email']) ?>
    <?= $this->Form->input('password', ['label' => 'Password']) ?>
    <?= $this->Form->button('Sign In') ?>
<?= $this->Form->end() ?>
