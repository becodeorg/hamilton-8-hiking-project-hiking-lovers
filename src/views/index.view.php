
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

