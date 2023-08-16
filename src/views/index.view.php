
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


<?php endif; 

