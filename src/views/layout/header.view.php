<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Hiking Lovers</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/"><strong>Hiking Lovers</strong></a></li>
            </ul>
            <ul>
                <?php if (!empty($_SESSION['user'])): ?>
                    Bonjour <?= $_SESSION['user']['nickname'] ?>
                    <li><a href="/logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>