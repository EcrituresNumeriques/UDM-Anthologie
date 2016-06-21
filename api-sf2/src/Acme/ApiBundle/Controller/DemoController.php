<?php

namespace Acme\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;

class DemoController extends FOSRestController
{

    public function getDemoAction()
    {
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }

    public function getUserAction()
    {
        $adminRole = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');
        $authentified = $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY');
        $isUser = $this->get('security.authorization_checker')->isGranted('ROLE_USER');
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if($user) {
            return new JsonResponse(array(
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'role' => $adminRole,
                'role2' => $authentified,
                'role3' => $isUser,
            ));
        }

        return new JsonResponse(array(
            'message' => 'User is not identified'
        ));
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