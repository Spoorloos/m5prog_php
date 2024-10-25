<?php
require 'components/database.php';

$connection = database_connect();
$albums = $connection->query('SELECT * FROM album')->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Albums</title>
    <? include_once 'components/head.php' ?>
</head>
<body>
    <? $active = 'Albums'; include 'components/header.php' ?>
    <main>
        <h1>Albums</h1>
        <ul class="card-list">
            <? foreach ($albums as $album): ?>
                <a href="/album.php?id=<?= $album['idalbum'] ?>">
                    <li class="card">
                        <img class="card__cover" src="<?= $album['cover'] ?>" alt="album cover">
                        <h2 class="card__name"><?= $album['name'] ?></h2>
                    </li>
                </a>
            <? endforeach; ?>
        </ul>
    </main>
</body>
</html>