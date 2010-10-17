<?php $view->extend('MadoquaBundle::layout') ?>

<section class="blog-post-read">
    
    <section class="blog-post">
        <!-- <span class="date">
            <?php echo strftime('%c', $post->getCreated()); ?>
        </span> -->
        <?php echo $post->getRawValue()->getParsedText(); ?>
    </section>
    
    <?php echo $view['actions']->output('MadoquaBundle:Post:latest'); ?>
    <!-- latest posts -->
    
</section>