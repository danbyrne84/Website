<?php

namespace controllers;

class ProjectController extends \library\Controller
{
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
