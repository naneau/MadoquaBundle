<?php
/**
 * chapter.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      View
 */
 
$view->extend('MadoquaBundle::layout');

?>
<section class="chapter">

    <h1>
        <?php echo $chapter->getName(); ?>
    </h1>
    
    <?php if ($chapter->hasParent()) : ?>
    <a href="<?php echo $view['router']->generate('book_chapter', array('path' => $chapter->getParent()->getPath())); ?>">
        <?php echo $chapter->getParent()->getName(); ?>
    </a>
    <?php endif; ?>
    
    <?php if (count($chapter->getChapters()) > 0) : ?>
    <ul class="chapters">

        <?php foreach($chapter->getChapters() as $subChapter) : ?>
        <li>
            <a href="<?php echo $view['router']->generate('book_chapter', array('path' => $subChapter->getPath())); ?>">
                <?php echo $subChapter->getName(); ?>
            </a>
        </li>
        <?php endforeach; ?>
    
    </ul>
    <?php endif; ?>

    <?php if (count($chapter->getPages()) > 0) : ?>

    <ul class="pages">

        <?php foreach($chapter->getPages() as $page) : ?>
        <li>
            <a href="<?php echo $view['router']->generate('book_page', array('path' => $page->getPath())); ?>">
                <?php echo $page->getTitle(); ?>
            </a>
        </li>
        <?php endforeach; ?>
    
    </ul>

    <?php endif; ?>
    
</section>