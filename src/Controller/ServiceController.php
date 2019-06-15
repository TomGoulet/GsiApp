<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class ServiceController extends AbstractController
{

    /**
     * @Route("/nos-métiers", name="service.index")
     * @return Response
     */

    public function index(): Response
    {
        return $this->render('pages/services/index.html.twig');
    }
}