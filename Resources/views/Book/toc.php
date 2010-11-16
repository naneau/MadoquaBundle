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
use  Symfony\Bundle\FrameworkBundle\Templating\Engine as View;

?>
<section class="toc">
    <ul>
        <?php echo outputChapter($book->getRawValue(), $view); ?>
    </ul>
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
function outputChapter(Chapter $chapter, View $view) 
{
?>
    <li class="chapter">
        <h1><?php echo $chapter->getName(); ?></h1>
    
        <?php if (count($chapter->getChapters()) > 0) : ?>
        <ul class="chapters">

            <?php foreach($chapter->getChapters() as $subChapter) : ?>
            <?php outputChapter($subChapter, $view); ?>
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
    </li>
<?php
} //end function
?>