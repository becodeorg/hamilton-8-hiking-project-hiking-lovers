<p> Salut </p>
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
