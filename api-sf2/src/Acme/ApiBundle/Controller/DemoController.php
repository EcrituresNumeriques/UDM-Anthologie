<?php

namespace Acme\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class DemoController extends FOSRestController
{

    public function getDemoAction()
    {
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }

    public function getDemo2Action()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }
}
