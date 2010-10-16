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
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <a class="more" href="<?php echo $view['router']->generate('post_read', array('identifier' => $post->getIdentifier())); ?>">
                More
            </a>
        </li>
        <?php endforeach; ?>
    </ul>

    <a class="blog-archive action" href="#">Archive</a>
</section>
