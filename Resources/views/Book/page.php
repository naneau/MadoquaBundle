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
    <?php echo $page->getRawValue()->getParsedText(); ?>
</section>