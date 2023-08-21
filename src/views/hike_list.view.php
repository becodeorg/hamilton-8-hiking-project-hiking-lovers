

<?php if (!empty($hikes)): ?>
  
    <ul>
        <?php foreach($hikes as $hike): ?>
            <div class="hike_container">
            <li>
                <a href="/hike?id=<?= $hike['id'] ?>">
                    <?= $hike['name'] ?><br>
                    Distance: <?= $hike['distance'] ?><br>
                    Duration: <?= $hike['duration'] ?><br>
                    Elevation Gain: <?= $hike['elevation_gain'] ?><br>
                </a>
            </li>
            </div>
        <?php endforeach; ?>
    </ul>
    
<?php endif; ?>
