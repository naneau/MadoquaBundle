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
    <h1>Latest posts</h1>
    <ul class="blog-latest-posts">
        <?php foreach($posts as $post) : ?>
        <li>
            <a class="title" href="<?php echo $view['router']->generate('post_read', array('identifier' => $post->getIdentifier())); ?>">
                <?php echo $post->getTitle(); ?>
            </a>
            <a href="<?php echo $view['router']->generate('post_read', array('identifier' => $post->getIdentifier())); ?>">            
                <span class="date"><?php echo strftime('%c', $post->getCreated()); ?></span>            
            </a>
            <p class="intro">
                <?php echo $post->getIntro(); ?>
            </p>
            <a class="more" href="<?php echo $view['router']->generate('post_read', array('identifier' => $post->getIdentifier())); ?>">
                More &raquo;
            </a>
        </li>
        <?php endforeach; ?>
    </ul>

    <!-- <a class="blog-archive action" href="#">Archive</a> -->
</section>
