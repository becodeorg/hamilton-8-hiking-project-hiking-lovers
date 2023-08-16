<div>
    <h2>My profile</h2>

    <p>First Name: <?= isset($user['firstname']) ? htmlspecialchars($user['firstname']) : '' ?></p>
    <p>Last Name: <?= isset($user['lastname']) ? htmlspecialchars($user['lastname']) : '' ?></p>
    <p>Username: <?= isset($user['nickname']) ? htmlspecialchars($user['nickname']) : '' ?></p>
    <p>Email: <?= isset($user['email']) ? htmlspecialchars($user['email']) : '' ?></p>
    <p>Password: *** (Password should not be displayed here)</p>
</div>

<div class="buttons">
    <button><a href="/">Edit my profile</a></button>
</div>

<div class="buttons">
    <button><a href="/addhike">Add a new hike</a></button>
</div>
