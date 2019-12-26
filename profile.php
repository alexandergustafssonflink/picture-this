<?php require __DIR__ . '/views/header.php';

isLoggedIn();

$getUser = getUser($_GET['id'], $pdo);
$name = $getUser['name'];
$avatar = $getUser['avatar_name'];
$biography = $getUser['biography'];
$getPost = getPost($_GET['id'], $pdo);


$profileId = $_GET['id'];
$visitId = $_SESSION['user']['id'];

?>

<p><?php checkForError(); ?></p>
<p><?php checkForConfirm(); ?></p>


<div class="profile-info">
    <img class="avatar" src="<?php echo "uploads/" . $avatar ?>" alt="hello">

    <div class="profile-text">
        <p class="user-name"> <?php echo $name; ?> </p>
        <p class="user-bio"> <?php echo $biography  ?> </p>
    </div>

</div>


<?php if ($profileId === $visitId) : ?>

    <!-- <a href="/app/users/logout.php">
        <img class="nav-icon" src="/icons/exit.png" alt="logout">
    </a> -->
    <a href="/app/users/logout.php"> <button>Log out</button> </a>

    <a href="edit-profile.php"> <button>Edit Profile</button> </a>
<?php endif; ?>



<?php if (empty($getPost)) : ?>
    <p class="info-message"> You dont have any posts yet..</p>
<?php endif; ?>


<?php foreach ($getPost as $post) : ?>
    <div class="post-container">



        <div class="author">
            <a href=" <?php echo 'profile.php?id=' . $post['author_id'] ?> ">
                <?php echo $name ?>
            </a>
            <img class="avatar-small" src="<?php echo "uploads/" . $avatar ?>" alt="avatar">
        </div>
        <img class="post-img" src=" <?php echo "uploads/" . $post['image_name'] ?> " loading="lazy" alt="">

        <div class="about-post">
            <div class="title-content-box">
                <h3> <?php echo $post['title']; ?> </h3>
                <p> <?php echo $post['content']; ?> </p>
            </div>

            <?php $displayLikes = displayLikes((int) $post['id'], $pdo); ?>
            <form class="like-form" action="app/posts/likes.php" method="post">

                <input type="hidden" name="id" value=" <?php echo $post['id'] ?> ">

                <button class="like-btn">
                    <?php if (isPostLiked($post['id'], $_SESSION['user']['id'], $pdo)) : ?>

                        <?php echo 'unlike'; ?>
                    <?php else : echo 'like'; ?>
                    <?php endif; ?></button>

                <p class="like-counter"> <?php echo $displayLikes ?> </p>
            </form>


        </div>

        <small class="date"><?php echo $post['date']; ?></small>
        <?php if ($profileId === $visitId) : ?>
            <a href=" <?php echo "edit-post.php?id=" . $post['id'] ?> "> <button class="edit-post"> Edit post </button> </a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>


<?php require __DIR__ . '/views/footer.php'; ?>