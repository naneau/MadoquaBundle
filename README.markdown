#MadoquaBundle

##Intro

MadoquaBundle is a very basic, markdown based blogging engine for Symfony2. It relies on a single directory with *.markdown files for its blog posts.

There's a simple service in Service/Post.php that describes the functionality.

You should be able to run this bundle in the latest [sf2 sandbox](http://symfony-reloaded.org/code).

##Configuration

Configuration options for the root config of your application.

    parameters:
        #directory of your posts
        madoqua.post.directory: "/abs/dir/to/your/posts/"
        
        #root url 
        madoqua.url: "http://your.url/"
        
        #Name of your blog
        madoqua.name: "A Name For Your Blog"
        
        #optional if you don't have a handler already
        exception_listener.controller: "Application\MadoquaBundle\Controller\ExceptionController::handleAction" 
    
    #DIC config
    madoqua.view: ~ #madoqua view helpers
    madoqua.post: ~ #madoqua post domain

##Markdown

The markdown used in the posts has but one simple extension over [vanilla](http://daringfireball.net/projects/markdown/), in code blocks it's possible to denote the language of the code with #lang on the first line. The code will be parsed with [GeSHi](http://qbnz.com/highlighter/).

##Dependencies

For the markdown parsing it relies on [KNPLabs' MarkdownBundle](http://github.com/knplabs/MarkdownBundle), although there's a [tiny patch](http://github.com/naneau/MarkdownBundle/commit/566384f1c4866808c0e1086e5f37d510485f7f38) required, so for the time being you'll have to use [naneau's branch](http://github.com/naneau/MarkdownBundle).