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

    public function getDemoEntityAction()
    {
        $eras = $this->get('doctrine')
            ->getRepository('AppBundle:Era')
            ->findAll()
        ;

        $view = $this->view($eras);
        return  $this->handleView($view);

    }

    public function getDemoTranslationAction()
    {

    }

}