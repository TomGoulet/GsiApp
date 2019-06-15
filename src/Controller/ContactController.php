<?php

namespace App\Controller;

use App\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ContactController extends AbstractController
{

    /**
     * @Route("/nous_contactez", name="contact.index")
     * @return Response
     */

    public function index(): Response
    {





        return $this->render('pages/contact/index.html.twig');
    }
}