<?php

namespace AppBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
                'group' => $user->getGroups(),
            ));
        }

        return new JsonResponse(array(
            'message' => 'User is not identified'
        ));
    }

    public function getAddgroupAction(){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $gm = $this->get('fos_user.group_manager');

        $group = $gm->createGroup("HETIC");
        $this->get('fos_user.group_manager')->updateGroup($group);

        $user->addGroup($group);
        $this->get('fos_user.user_manager')->updateUser($user);



        $data = array("hello" => $group);
        $view = $this->view($data);
        return $this->handleView($view);
    }

    public function getGroupsAction(){
        $group = $this->get('fos_user.group_manager')->findGroupBy(array('id' => 1));
        $group->getName();
        $view = $this->view(array("groups" => "name".$group->getName()), 200);
        return $this->handleView($view);
    }

    public function postDemoEntityAction(Request $request)
    {
        $author = new Author();
        $form = $this->createForm(new AuthorType(), $author, array("method" => $request->getMethod()));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $view = $this->view($entity,200);
            return $this->handleView($view);
        }
        $view = $this->view($request,400);
        return $this->handleView($view);
    }

    public function getDemoTranslationAction()
    {

    }

}