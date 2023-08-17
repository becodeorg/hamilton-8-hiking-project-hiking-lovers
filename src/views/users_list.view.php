<div class="userspage">
    <form action="/userlist" class="userlistsearch" method="GET">
        <label for="search"></label>
        <input type="search" name="search_query" placeholder="firstname">
        <button type="submit">Search</button>
    </form>

    <?php if (!empty($_GET['search_query'])): ?>
        <div class="listing_user">
            <ul>
                <?php foreach ($users as $user): ?>
                    <li>
                        <?= $user['firstname'] . ' ' . $user['lastname']; ?>
                        <div>
                            <button class="curd_user">Add+</button>
                            <button class="curd_user">Send a message</button>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else: ?>
        <div class="listing_user">
            <ul>
                <?php foreach ($users as $user): ?>
                    <li>
                        <?= $user['firstname'] . ' ' . $user['lastname']; ?>
                        <div>
                            <button class="curd_user">Add+</button>
                            <button class="curd_user">Send a message</button>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>