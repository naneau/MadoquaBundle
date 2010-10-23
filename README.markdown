#MadoquaBundle

##Intro

MadoquaBundle is a very basic, markdown based blogging engine for Symfony2. It relies on a single directory with *.markdown files for its blog posts.

There's a simple service in Service/Post.php that describes the functionality.

##Configuration

    parameters:
        madoqua.post.directory: "/abs/dir/to/your/posts/"
        exception_listener.controller: "Application\MadoquaBundle\Controller\ExceptionController::handleAction" #optional if you don't have a handler already
        madoqua.url: "http://your.url/"
        madoqua.title: "A Name For Your Blog"
    
    madoqua.view: ~ #madoqua view helpers
    madoqua.post: ~ #madoqua post domain

##Markdown

The markdown used in the posts has but one simple extension over [vanilla](http://daringfireball.net/projects/markdown/), in code blocks it's possible to denote the language of the code with #lang on the first line. The code will be parsed with [GeSHi](http://qbnz.com/highlighter/).

##Dependencies

For the markdown parsing it relies on [KNPLabs' MarkdownBundle](http://github.com/knplabs/MarkdownBundle)