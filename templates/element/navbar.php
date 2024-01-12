<!-- Navbar links based on user authentication -->

<ul class="navbar-nav ml-auto">
    <?php if ($this->request->getSession()->read('Auth')) : ?>
        <!-- Display these links for logged-in users -->
        <li class="nav-item">
            <?= $this->Html->link('User List', ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']) ?>
        </li>
    <?php else : ?>
        <!-- Display these links for not logged-in users -->
        <li class="nav-item">
            <?= $this->Html->link('Sign Up', ['controller' => 'Users', 'action' => 'signup'], ['class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link('Sign In', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']) ?>
        </li>
    <?php endif; ?>
</ul>
