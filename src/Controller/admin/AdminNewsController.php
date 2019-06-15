<?php

namespace App\Controller\admin;

use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AdminNewsController extends AbstractController
{
    /**
     * @var NewsRepository
     */

    private $repository;

    public function  __construct(NewsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/admin", name="admin.news.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function index()
    {
        $results = $this->repository->findAll();
        return $this->render('admin/news/index.html.twig', compact('results'));
    }

    /**
     * @Route("/admin/{id}", name="admin.news.edit")
     * @param News $news
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function edit(News $news)
    {
        return $this->render('admin/news/edit.html.twig', compact('news'));
    }
}
