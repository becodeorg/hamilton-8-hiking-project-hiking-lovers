<form action="/updatehike" method="post" class="hike_container">
    <div>

        <label for="name">Hike name</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($hike['name']) ?>"/>
    </div>
    <div>
        <label for="distance">Distance</label>
        <input type="text" id="distance" name="distance"value="<?= htmlspecialchars($hike['distance']) ?>"/>
    </div>
    <div>
        <label for="duration">Duration</label>
        <input type="text" id="duration" name="duration" value="<?= htmlspecialchars($hike['duration']) ?>"/>
    </div>
    <div>
        <label for="elevation_gain">Elevation Gain</label>
        <input type="text" id="elevation_gain" name="elevation_gain" value="<?= htmlspecialchars($hike['elevation_gain']) ?>" />
    </div>
    <div>
        <label for="elevation_gain">Elevation Gain</label>
        <input type="text" id="elevation_gain" name="elevation_gain" value="<?= htmlspecialchars($hike['elevation_gain']) ?>" />
    </div>
    

    <button type="submit">Update Hike</button>

</form>

