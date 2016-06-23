<?php
/**
 * Created by PhpStorm.
 * User: karael
 * Date: 21/06/2016
 * Time: 01:05
 */

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Author;
use AppBundle\Form\AuthorType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Author controller.
 */
class AuthorController extends BaseApiController
{

    /**
     * @Route("/author/new", name="api_v1_author_create")
     * @Method({"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $entity = new Author();
        $language = $this->jsonToArray($request->getContent());
        if ($datas) {

        }

        return $this->handleView();
    }
    
    /**
     * @see BaseApiController::getRepository()
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('AnotherNameAnotherBundle:Event');
    }

    /**
     * @see BaseApiController::getNewEntity()
     * @return Object
     */
    public function getNewEntity()
    {
        return new Author();
    }

    /**
     * @see BaseApiController::getFormType()
     * @return Object
     */
    public function getFormType()
    {
        return new AuthorType();
    }

    private function jsonToArray($json){
        if ($json) {
            return json_decode($json, true);
        }
        return false;
    }
}