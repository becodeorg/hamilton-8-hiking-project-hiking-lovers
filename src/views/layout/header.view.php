<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/style.css">
    <title>Hiking Lovers</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/"><strong>Hiking Lovers</strong></a></li>
                    <?php if (!empty($_SESSION['user'])): ?>
                        Bonjour <?= $_SESSION['user']['nickname'] ?>

                       <li><a href="/logout">Logout</a></li>
                    <?php else: ?>
                    <div class="buttons">
                        <button><a href="/register">Register</a></button>
                    </div>
                    <?php endif; ?>
                <li><a href="/hikes-list">All hikes</a></li>
            </ul>
        </nav>
    </header>
    <main>

