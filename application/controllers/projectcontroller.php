<?php

namespace controllers;

class ProjectController extends \library\Controller
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
	    // get the homepage view
        $view = \library\View::fromFile(APP_PATH . '/views/projects.tpl');
        $this->getLayout()->content = $view;

        $this->render();    	
    }
}
?>
