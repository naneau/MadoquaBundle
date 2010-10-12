<?php $view->extend('MadoquaBundle::layout') ?>

<section class="blog-post">
    <?php echo $post->getRawValue()->getParsedText(); ?>
</section>