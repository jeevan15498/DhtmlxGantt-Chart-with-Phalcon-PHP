<?php

use Phalcon\Mvc\Url;

class IndexController extends ControllerBase
{
    public function initialize() {
        $this->view->setTemplateAfter('homeLayout'); // Layout
        $this->tag->setTitle('Home Page'); // By Default Page Title
    }

    public function indexAction() {
        $this->tag->prependTitle('Index - '); // Current Page Title
    }
}

