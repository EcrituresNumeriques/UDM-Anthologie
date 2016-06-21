<?php
/**
 * Created by PhpStorm.
 * User: karael
 * Date: 21/06/2016
 * Time: 01:05
 */

namespace Acme\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\Serializer\SerializationContext;

use AppBundle\Entity\Author;

class AuthorController extends FOSRestController
{

}