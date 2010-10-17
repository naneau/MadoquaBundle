<?php
/**
 * index.php
 *
 * @category        NaneauBlog
 * @package         View
 * @subpackage      Layout
 */
?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('/bundles/madoqua/css/naneau.css'); ?>" media="all">  
    
    <title>Naneau</title>
</head>

<body>
    <div id="all">
        <section id="top">
            <h1>Naneau</h1>
        </section>
        
        <section id="content">
            <?php $view['slots']->output('_content') ?>
            <div class="clear"></div>
        </section>

    </div>
</body>
</html>