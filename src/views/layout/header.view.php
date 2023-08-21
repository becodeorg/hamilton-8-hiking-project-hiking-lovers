<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style/style.css" rel="stylesheet">
    <script>
        function confirmDelete() { 
            return confirm("Are you sure you want to delete this hike?");
            }
    </script>
    <title>Hiking Lovers</title>
</head>
<body>
    <header>
        <nav>
            <a href="/"><strong>Hiking Lovers</strong></a>
                <?php if (!empty($_SESSION['user'])): ?>
                    Bonjour <?= $_SESSION['user']['nickname'] ?>
                    <a href="/logout">Logout</a>
                <?php else: ?>
                <div class="buttons">
                    <button><a href="/login">Login</a></button>
                    <button><a href="/register">Register</a></button>
                </div>
                <?php endif; ?>

        </nav>
    </header>
    <main>

