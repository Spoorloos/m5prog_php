<?php
require 'components/database.php';
include 'components/add_to_playlist.php';

$connection = database_connect();
$songs = $connection->query('SELECT s.*, a.cover FROM song AS s JOIN album AS a ON s.album_id = a.idalbum')->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Songs</title>
    <? include_once 'components/head.php' ?>
</head>
<body>
    <? $active = 'Songs'; include 'components/header.php' ?>
    <main>
        <h1>Songs</h1>
        <ul class="card-list">
            <? foreach ($songs as $song): ?>
                <li class="card">
                    <img class="card__cover" src="<?= $song['cover'] ?>" alt="album cover">
                    <h2 class="card__name"><?= $song['name'] ?></h2>
                    <? render_playlist_btn($song['idsong'], $connection); ?>
                    <a class="btn btn-primary" href="<?= $song['media_link'] ?>">Listen</a>
                </li>
            <? endforeach; ?>
        </ul>
    </main>
</body>
</html>