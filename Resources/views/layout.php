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
    
    <title><?php echo $view['title']->getTitle(); ?></title>
        
    <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('/bundles/madoqua/css/naneau.css'); ?>" media="all">
    
    <!--[if lte IE 8]>
    <script type="text/javascript">
    (function(){if(!/*@cc_on!@*/0)return;var e = "abbr,article,aside,audio,bb,canvas,datagrid,datalist,details,dialog,eventsource,figure,footer,header,hgroup,mark,menu,meter,nav,output,progress,section,time,video".split(',');for(var i=0;i<e.length;i++){document.createElement(e[i])}})()
    </script>
    <![endif]-->
    

</head>

<body>
    <div id="all">
        
        <section id="top">
            <h1><?php echo $view['title']->getTitle(); ?></h1>
        </section>
        
        <section id="content">
            <?php $view['slots']->output('_content') ?>
            <div class="clear"></div>
        </section>
        
    </div>
</body>
</html>