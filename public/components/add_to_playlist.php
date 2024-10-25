<?php

function render_playlist_btn($id, $connection) {
    $playlists = $connection->query('SELECT * FROM playlist')->fetch_all(MYSQLI_ASSOC);

    ?>
        <button type="button" class="btn btn-secondary z-3" data-bs-toggle="modal" data-bs-target="#add-to-playlist">
            Add To Playlist
        </button>
        <div class="modal fade" id="add-to-playlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="modal-content" id="playlist-form" method="POST" action="/playlists.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add to playlist</h5>
                    </div>
                    <div class="modal-body form-group">
                        <label for="playlist">Select a playlist:</label>
                        <select class="form-select" name="add_playlistid" id="playlist">
                            <? foreach ($playlists as $playlist): ?>
                                <option value="<?= $playlist['idplaylist']?>"><?= $playlist['name'] ?></option>
                            <? endforeach; ?>
                        </select>
                        <input name="add_songid" type="number" value="<?= $id ?>" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
                <script>
                    const playlistForm = document.querySelector("#playlist-form");
                    const playlistSelect = document.querySelector("#playlist");

                    playlistForm.addEventListener('submit', () => {
                        playlistForm.action = "/playlist.php?id=" + playlistSelect.value;
                    });
                </script>
            </div>
        </div>
    <?php
}