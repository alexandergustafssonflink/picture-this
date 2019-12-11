<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>

    <?php if (isset($_SESSION['user'])) : ?>
        <?php $user = $_SESSION['user'];
            echo "Welcome " . $user['name'];

            ?>

        <!-- Check for error  -->
        <?php foreach ($errors as $error) : ?>
            <?php echo $error; ?>
        <?php endforeach; ?>

    <?php endif; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>