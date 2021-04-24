<?php
    foreach($posts as $post) {  ?>
    <div class="box">
        <h4><?= $post['quote'] ?></h4>
        <p><?= $post['author'] ?></p>
    </div>
    
<?php }  ?>