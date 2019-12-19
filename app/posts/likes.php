<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['like'])) {

    $postId = (int) $_GET['id'];
    $userId = (int) $_SESSION['user']['id'];



    if (isPostLiked($postId, $userId, $pdo)) {
        //Delete from database

        $statement = $pdo->prepare('DELETE FROM likes WHERE post_id = :post_id AND user_id = :user_id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':post_id' => $postId,
            ':user_id' => $userId
        ]);
    } else {
        // If not liked, insert into database

        $statement = $pdo->prepare('INSERT INTO likes (post_id, user_id)
    VALUES (:post_id, :user_id)');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':post_id' => $postId,
            ':user_id' => $userId,
        ]);
    }
}

redirect('/');
