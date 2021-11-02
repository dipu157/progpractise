
<div>
    <div class="float-left">
        <p>
            <a href="/progpractise/phpHasinVai/crud/index.php?task=report">All Students</a> |
            <a href="/progpractise/phpHasinVai/crud/index.php?task=add">Add Students</a> |
            <?php if(isAdmin()) : ?>
            <a href="/progpractise/phpHasinVai/crud/index.php?task=seed">SEED</a>
            <?php endif ?>
        </p>
    </div>

    <div class="float-right">
        <?php if($_SESSION['loggedin']): ?>
        <a href="/progpractise/phpHasinVai/crud/auth.php?logout=true">Log Out <?php echo $_SESSION['role']; ?></a>
        <?php else: ?>
            <a href="/progpractise/phpHasinVai/crud/auth.php">Log In</a>
        <?php endif ?>
    </div>
</div>