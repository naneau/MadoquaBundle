<?php $view->extend('MadoquaBundle::layout') ?>

<section class="exception">
    <h1>Woops</h1>
    <p>
        Looks like you're trying to access a page that doesn't exist;
    </p>
    
    <h2>Why don't you try your luck with</h2>
    
    <?php echo $view['actions']->output('MadoquaBundle:Post:latest', array('count' => 10)); ?>
    <!-- latest posts -->
    
</section>