<?php

namespace App\Controller\admin;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AdminNewsController extends AbstractController
{
    /**
     * @var NewsRepository
     */

    private $repository;

    /**
     * @var ObjectManager
     */

    private $em;

    public function  __construct(NewsRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
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
     * @Route ("/admin/news/create", name="admin.news.new")
     */
    public function new(Request $request)
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($news);
            $this->em->flush();
            return $this->redirectToRoute( 'admin.news.index');
        }

        return $this->render('admin/news/new.html.twig', [
            'news' => $news,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.news.edit")
     * @param News $news
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function edit(News $news, Request $request)
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute( 'admin.news.index');
        }

        return $this->render('admin/news/edit.html.twig', [
            'news' => $news,
            'form' => $form->createView()
            ]);
    }
}
