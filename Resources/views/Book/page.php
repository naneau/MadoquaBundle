<?php
/**
 * page.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      View
 */
$view->extend('MadoquaBundle::layout'); 
?>
<section class="page">
    <a class="chapter-up" href="<?php echo $view['router']->generate('book_chapter', array('path' => $page->getChapter()->getPath())); ?>">
        Terug naar <?php echo $page->getChapter()->getName(); ?>
    </a>
    
    <?php echo $page->getRawValue()->getParsedText(); ?>
</section>