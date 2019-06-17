<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CguController extends AbstractController
{
    /**
     * @Route("/conditions-générales", name="cgu.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('cgu/index.html.twig');
    }
}
