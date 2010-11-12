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

    <?php if (count($chapter->getChapters()) > 0) : ?>
    <ul class="chapters">

        <?php foreach($chapter->getChapters() as $subChapter) : ?>
        <li>
            <a href="<?php echo $view['router']->generate('book_chapter', array('chapter' => $subChapter->getPath())); ?>">
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
            <?php echo $page->getTitle(); ?>
        </li>
        <?php endforeach; ?>
    
    </ul>

    <?php endif; ?>
    
</section>