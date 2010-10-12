<?php
/**
 * latest.php
 * 
 * latest posts
 * 
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Resource
 */

?>
<section id="blog-latest-posts">
    <h1>Latest blog posts</h1>
    <ul class="blog-last-posts">
        <?php foreach($posts as $post) : ?>
        <li>
            <?php echo $post->getTitle(); ?>
            <span class="date"><?php echo strftime('%d-%m-%Y'); ?></span>
        </li>
        <?php endforeach; ?>
    </ul>

    <a class="blog-archive" src="#">Archive</a>
</section>
