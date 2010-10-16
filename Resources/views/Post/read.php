<?php $view->extend('MadoquaBundle::layout') ?>

<section class="blog-post">
    <!-- <span class="date">
        <?php echo strftime('%c', $post->getCreated()); ?>
    </span> -->
    <?php echo $post->getRawValue()->getParsedText(); ?>
</section>