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
<html lang="en-EN">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?php// echo $view->assets->getUrl('/bundles/madoqua/css/naneau.css'); ?>" media="all">  
    <link rel="stylesheet" type="text/css" href="/bundles/madoqua/css/naneau.css" media="all">      
    <title>Naneau</title>
</head>
<body>
    <div id="all">
        <!-- <div id="top">
            <h1>Naneau</h1>
        </div> -->
        
        <section id="content">
            <?php $view['slots']->output('_content') ?>
        </section>
        
        <section id="footer">
            <!-- <h1>More</h1> -->
            <div class="footer-wrapper">
                
                <?php echo $view['actions']->output('MadoquaBundle:Post:latest'); ?>
                
                <section id="welcome">
                    <h2>Welcome</h2>
                
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    
                    <a href="#">Contact</a>
                </section>
            
                <div class="clear" />
            </div>
        </section>
    </div>
</body>
</html>