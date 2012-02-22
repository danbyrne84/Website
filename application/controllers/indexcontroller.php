<?php

namespace controllers;

class IndexController extends \library\Controller
{

	/**
	 * Constructor
	 * 
	 */
	public function __construct()
	{
		$layout = \library\View::fromFile(APP_PATH . '/layouts/main.tpl');
		$this->setLayout($layout);
	}
	
	/**
	 * IndexAction
	 * 
	 */
    public function indexAction()
    {
    	// set a two column layout
        $twoColumn = \library\View::fromFile(APP_PATH . '/layouts/two-column.tpl');
    
	    // get the homepage view
        $view = \library\View::fromFile(APP_PATH . '/views/home.tpl');
        
        // put latest blog entries on homepage
        $wordpress = new \plugins\Wordpress('http://www.danielbyrne.net/feed/');
    	$latestPosts = $wordpress->getLatest(5);
    	
    	//@todo sort it out....
    	$posts = array();
    	foreach($latestPosts as $post)
    	{
    		$posts []= $post->toArray();
    	}
    	
    	$view->posts = $posts;
    	
    	// render
        $twoColumn->content = $view;
        $twoColumn->sidebarLeft = \library\View::fromFile(APP_PATH . '/views/sidebar-about-me.tpl'); 

        $this->getLayout()->content = $twoColumn;

        $this->render();    	
    }
    
    /**
     * aboutAction
     * 
     */
    public function aboutAction()
    {
    	$view = \library\View::fromFile(APP_PATH . '/views/about-me.tpl');
    	
    	$this->getLayout()->content = $view;
    	$this->render();
    }
    
    /**
     * Contact me action
     * 
     */
    public function contactAction()
    {
    	$view = \library\View::fromFile(APP_PATH . '/views/contact-me.tpl');

    	if ( isset($_POST['formvar']) && 'contact-me' === $_POST['formvar'] )
    	{
    		// process the submitted form
    		$view->message = "Thanks, I'll try and get back to you ASAP!";
    	}
    	else
    	{
    		$view->message = "Please fill out the fields below to get in touch.";
    	}
    	
    	$this->getLayout()->content = $view;
    	$this->render();
    }
    
    /**
     * Test action, for...testing
     * 
     */
    public function testAction()
    {   	
    	$m = new \Mongo();
    	$db = $m->selectDB("website");
    	
    	$results = $db->blog->findone();
    	
    	$content = "Mongo DB test code:<br/><br/>";
    	$content .= '$m = new Mongo();<br/>';
    	$content .= '$db = $m->selectDB("website");<br/>';
    	$content .= '$results = $db->blog->findone();<br/><br/>';
    	
    	$content .=  'search result are ' . '<br /><pre style="text-align:left;">' . print_r($results, true) . '</pre>';
    	$content .=  '<br/><br/>';
    	$content .=  'data is: ' . '<br /><pre style="text-align:left;">' . print_r($results['data'], true) . '</pre>';
    
    	$this->getLayout()->content = $content;
    	$this->render();
    	
    }
    
    /**
     * notFoundAction
     * 
     */
    public function notFoundAction()
    {
    	$view = \library\View::fromFile(APP_PATH . '/views/404-not-found.tpl');
    	
    	$this->getLayout()->content = $view;
    	$this->render();
    }
    
}

?>
