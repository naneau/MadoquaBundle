<?php
/**
 * full.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      View
 */
 
$view->extend('MadoquaBundle::layout');

use Application\MadoquaBundle\Model\Book\Page;
use Application\MadoquaBundle\Model\Book\Chapter;

?>
<section class="book">

    <?php echo outputChapter($book->getRawValue()); ?>
    
</section>

<?php

/**
 * recursive chapter output 
 * 
 * ... yeah :(
 *
 * @param Chapter $chapter 
 * @return string
 */
function outputChapter(Chapter $chapter) 
{
?>
    <h1><?php echo $chapter->getName(); ?></h1>
    
    <?php if (count($chapter->getChapters()) > 0) : ?>
    <ul class="chapters">

        <?php foreach($chapter->getChapters() as $subChapter) : ?>
        <?php outputChapter($subChapter); ?>
        <?php endforeach; ?>
    
    </ul>
    <?php endif; ?>

    <?php if (count($chapter->getPages()) > 0) : ?>

    <ul class="pages">
        <h2>Pagina's</h2>
        <?php foreach($chapter->getPages() as $page) : ?>
        <?php echo $page->getParsedText(); ?>
        <?php endforeach; ?>
    
    </ul>

    <?php endif; ?>
<?php
} //end function
?>