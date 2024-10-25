<?php
    $id = $_GET['id'];
    if (empty($id)) {
        header('Location: /albums');
        return;
    }

    require 'components/database.php';
    include 'components/add_to_playlist.php';

    $connection = database_connect();

    // Get album
    $query = $connection->prepare('SELECT * FROM album WHERE idalbum=?');
    $query->bind_param('i', $id);
    $query->execute();
    $album = $query->get_result()->fetch_assoc();
    $query->close();

    // Get songs
    $query = $connection->prepare('SELECT * FROM song WHERE album_id=?');
    $query->bind_param('i', $id);
    $query->execute();
    $songs = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    $query->close();
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
        <h1><?= $album['name'] ?></h1>
        <div class="d-flex gap-4">
            <img src="<?= $album['cover'] ?>" alt="cover">
            <ul class="card-list">
                <? foreach ($songs as $song): ?>
                    <li class="card">
                        <h2 class="card__name"><?= $song['name'] ?></h2>
                        <? render_playlist_btn($song['idsong'], $connection); ?>
                        <a class="btn btn-primary" href="<?= $song['media_link'] ?>">Listen</a>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    </main>
</body>
</html>