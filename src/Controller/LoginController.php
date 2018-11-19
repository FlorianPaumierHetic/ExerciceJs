<?php

namespace App\Controller;

use App\Controller\RestController;
use App\Entity\Login;
use App\Repository\LoginRepository;
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Created by PhpStorm.
 * User: florianpaumier
 * Date: 19/11/2018
 * Time: 10:03
 */

class LoginController extends RestController
{

    public function indexAction(){
        return $this->render("view.html.twig");
    }

    /**
     * @Rest\RequestParam(name="login", nullable=false, description="state to update")
     * @Rest\RequestParam(name="password", nullable=false, description="application to update")
     * @param ParamFetcher $paramFetcher
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postLoginAction(ParamFetcher $paramFetcher){
        $entityManager = $this->getDoctrine()->getManager();

        $login = $paramFetcher->get("login");
        $password = $paramFetcher->get("password");

        if(!$login)
            return $this->notFound("pas de login");

        if(!$password)
            return $this->notFound("Pas de password");

        $log = $entityManager->getRepository(Login::class)->findOneBy([
            "Login" => $login,
            "Password" => $password
        ]);


        if(is_null($log)){
           return $this->notFound("Vous n'êtes pas connu");
        }

        $view = View::create();

        $view->setData("Ok");
        return $this->handleView($view);
    }

}