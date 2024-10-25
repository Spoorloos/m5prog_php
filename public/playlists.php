<?php
    require 'components/database.php';

    $connection = database_connect();
    $playlist_name = $_POST['playlistname'] ?? '';

    if (!empty($playlist_name)) {
        $query = $connection->prepare('INSERT INTO playlist VALUES (null, ?)');
        $query->bind_param('s', $playlist_name);
        $query->execute();
        $query->close();
    }

    $playlists = $connection->query('SELECT * FROM playlist')->fetch_all(MYSQLI_ASSOC);
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
        <div class="d-flex gap-4 align-items-center">
            <h1>Playlists</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#playlist-modal">
                Create
            </button>
            <div class="modal fade" id="playlist-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form class="modal-content" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create new playlist</h5>
                        </div>
                        <div class="modal-body form-group">
                            <input class="form-control" type="text" id="playlist-name" name="playlistname" placeholder="Playlist Name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <ul class="card-list">
            <? foreach ($playlists as $playlist): ?>
                <a href="/playlist.php?id=<?= $playlist['idplaylist'] ?>">
                    <li class="card">
                        <h2 class="card__name"><?= $playlist['name'] ?></h2>
                    </li>
                </a>
            <? endforeach; ?>
        </ul>
    </main>
</body>
</html>