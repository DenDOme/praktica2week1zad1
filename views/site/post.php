<h1>Список</h1>
<ol>
    <?php
    foreach($posts as $post){
        echo '<li>' . $post->title . '</li>';
    }
    ?>
</ol>