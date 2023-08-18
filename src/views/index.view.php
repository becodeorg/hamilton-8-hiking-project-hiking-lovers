<<<<<<< HEAD

<h2>List of hikes</h2>

<?php if (!empty($hike)): ?>
    <section >
        <?php foreach($hike as $hike): ?>
            <div class=hike_container>
                <a href="/hike?id=<?= $hike['id'] ?>">
                    <?= $hike['name'] ?>
                 </a>
                 <div><?= $hike['distance'] ?></div>
                 <div><?= $hike['duration']?></div>
                 <div><?= $hike['elevation_gain']?></div>
                 <div><?= $hike['created_at']?></div>
                 <div><?= $hike['updated_at']?></div>

            </div>
        <?php endforeach; ?>

        </section>

        <div>
    <h2>My profile"</h2>


    <p>First Name<?= $user['firstname']?></p>
    <p>Last Name<?= $user['lastname']?></p>
    <p>Username<?= $user['nickname']?></p>
    <p>Email<?= $user['email']?></p>
    <p>Password<?= $user['password']?></p>

</div>


<?php endif; 
=======
<form action="#" method="post" class="login">
    <div>
        <label for="nickname">Username</label>
        <input type="text" id="nickname" name="nickname"/>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password"/>
    </div>
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

