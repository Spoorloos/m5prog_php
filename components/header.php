<?php
    $pages = [
        'Home' => 'index.php',
        'Single' => 'single.php',
        'About' => 'about.php',
    ];
    $active ??= 'Home';
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <? foreach ($pages as $name => $path): ?>
                        <li class="nav-item">
                            <? if ($name === $active): ?>
                                <a class="nav-link active" aria-current="page" href="<?= $path ?>"><?= $name ?></a>
                            <? else: ?>
                                <a class="nav-link" href="<?= $path ?>"><?= $name ?></a>
                            <? endif ?>
                        </li>
                    <? endforeach; ?>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</header>