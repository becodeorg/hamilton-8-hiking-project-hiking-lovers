<div class="userspage">
    <form action="/userlist" class="userlistsearch" method="GET">
        <label for="search"></label>
        <input type="search" name="search_query" placeholder="firstname">
        <button type="submit">Search</button>
    </form>

    <div class="listing_user">
        <ul>
            <?php foreach ($users as $user): ?>
                <li>
                    <?= $user['firstname'] . ' ' . $user['lastname']; ?>
                    <div>
                        <buttton class="curd_user">Add+</buttton>
                        <buttton class="curd_user">Send a message</buttton>
                    </div>
                
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>