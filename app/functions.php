<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}


/**
 * Get a user from database to frontend
 *
 * @param string $bdPath
 * @param integer $userId
 * @return array
 */
function getUser(int $userId, string $dbPath = 'sqlite:app/database/database.db'): array
{
    $pdo = new PDO($dbPath);
    $query = 'SELECT *
    FROM users WHERE id = :id';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':id' => $userId
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}
