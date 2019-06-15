<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class GroupController extends AbstractController
{

    /**
     * @Route("/le-groupe", name="group.index")
     * @return Response
     */

    public function index(): Response
    {
        return $this->render('pages/group/index.html.twig');
    }
}