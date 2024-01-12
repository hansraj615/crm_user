<!-- Footer links based on user authentication -->
<footer class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <?php if ($this->request->getSession()->read('Auth')) : ?>
            <!-- Display these links for logged-in users -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?= $this->Html->link('User List', ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('Sign Out', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']) ?>
                </li>
            </ul>
        <?php else : ?>
            <!-- Display these links for not logged-in users -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?= $this->Html->link('Sign Up', ['controller' => 'Users', 'action' => 'signup'], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('Sign In', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']) ?>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</footer>
