<?php
    $id = $_GET['id'];
    if (empty($id)) {
        header('Location: /playlists');
        return;
    }

    require 'components/database.php';
    include 'components/add_to_playlist.php';

    $connection = database_connect();

    // Add song
    $add_playlistid = $_POST['add_playlistid'] ?? '';
    $add_songid = $_POST['add_songid'] ?? '';
    if (!empty($add_playlistid)) {
        $query = $connection->prepare('INSERT INTO playlist_has_song VALUES (?, ?)');
        $query->bind_param('ii', $add_playlistid, $add_songid);
        $query->execute();
        $query->close();
    }

    // Get playlist
    $query = $connection->prepare('SELECT * FROM playlist WHERE idplaylist=?');
    $query->bind_param('i', $id);
    $query->execute();
    $playlist = $query->get_result()->fetch_assoc();
    $query->close();

    // Get songs
    $query = $connection->prepare('SELECT s.*, a.cover FROM playlist_has_song AS phs JOIN song AS s ON phs.song_idsong = s.idsong JOIN album as a ON s.album_id = a.idalbum WHERE phs.playlist_idplaylist = ?');
    $query->bind_param('i', $id);
    $query->execute();
    $songs = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    $query->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Playlists</title>
    <? include_once 'components/head.php' ?>
</head>
<body>
    <? $active = 'Playlists'; include 'components/header.php' ?>
    <main>
        <h1>Playlists - <?= $playlist['name'] ?></h1>
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