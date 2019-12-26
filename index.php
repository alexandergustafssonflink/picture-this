<?php

require __DIR__ . '/views/header.php';



?>

<p><?php checkForError(); ?></p>
<p><?php checkForConfirm(); ?></p>

<article>

    <?php if (!isset($_SESSION['user']['id'])) : ?>

        <?php redirect('/login.php'); ?>

        <!-- <a <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Login</a> -->

    <?php endif; ?>




    <?php if (isset($_SESSION['user'])) : ?>
        <?php $user = $_SESSION['user'];
        echo "Welcome " . $user['name']; ?>


        <?php $allPosts = getAllPosts($pdo); ?>

        <?php foreach ($allPosts as $post) : ?>



            <div class="post-container">


                <?php $displayLikes = displayLikes((int) $post['id'], $pdo); ?>

                <div class="author">
                    <a href=" <?php echo 'profile.php?id=' . $post['author_id'] ?> ">
                        <?php echo $post['name'] ?>
                    </a>
                    <img class="avatar-small" src="<?php echo "uploads/" . $post['avatar_name'] ?>" alt="avatar">
                </div>

                <img class="post-img" src=" <?php echo "uploads/" . $post['image_name'] ?> " loading="lazy">


                <div class="about-post">

                    <div class="title-content-box">
                        <h3> <?php echo $post['title']; ?> </h3>
                        <p> <?php echo $post['content']; ?> </p>

                    </div>


                    <!-- Like button -->
                    <form class="like-form" action="app/posts/likes.php" method="post">

                        <input type="hidden" name="id" value=" <?php echo $post['id'] ?> ">

                        <button class="like-btn">
                            <?php if (isPostLiked($post['id'], $_SESSION['user']['id'], $pdo)) : ?>

                                <!-- <img class="like-icon" src="/icons/liked.png" class="like-icon" alt="like"> -->

                                <?php echo 'unlike'; ?>

                            <?php else : echo 'like'; ?>

                                <!-- <img class="like-icon" src="/icons/unliked.png" class="like-icon" alt="unlike"> -->
                            <?php endif; ?></button>

                        <p class="like-counter"> <?php echo $displayLikes ?> </p>
                    </form>
                </div>
                <small><?php echo $post['date']; ?></small>

                <!-- Comments -->
                <?php $comments = getAllComments((int) $post['id'], $pdo); ?>
                <?php foreach ($comments as $comment) : ?>
                    <div class="comments">
                        <p class="comment-by"> <?php echo $comment['name']; ?> </p>
                        <p class="comment"> <?php echo $comment['comment']; ?> </p>
                    </div>
                <?php endforeach; ?>


                <form class="comments-form" action="app/posts/comment-post.php" method="post">

                    <div>
                        <input type="hidden" name="post-id" value="<?php echo $post['id'] ?> ">
                        <!-- <label for="comment"></label> -->
                        <input type="text" name="comment" placeholder="Add comment..">
                    </div>
                    <button type="submit">Send</button>
                </form>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</article>


<?php require __DIR__ . '/views/footer.php'; ?>