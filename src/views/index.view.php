<form action="#" method="post">
    <div>
        <label for="nickname">Username</label>
        <input type="text" id="nickname" name="nickname"/>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password"/>
    </div>
<<<<<<< HEAD
    <button type="submit">Login</button>
</form>
=======
    <div>
        <button type="submit">Login</button>
    </div>
    <div>
        <p>Not count?</p><button><a href="/register">Inscription</a></button>
    </div>
</form>

<?php if (!empty($hikes)): ?>
    <ul>
        <?php foreach($hikes as $hike): ?>
            <li>
                <a href="/hike?name=<?= $hike['name'] ?>">
                    <?= $hike['name'] ?><br>
                    Distance: <?= $hike['distance'] ?><br>
                    Duration: <?= $hike['duration'] ?><br>
                    Elevation Gain: <?= $hike['elevation_gain'] ?><br>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

>>>>>>> marius
