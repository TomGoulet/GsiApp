<?php

namespace App\Controller\admin;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Class AdminNewsController
 * @package App\Controller\admin
 */
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

    /**
     * AdminNewsController constructor.
     * @param NewsRepository $repository
     * @param ObjectManager $em
     */
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
            $this->addFlash('success', 'Article crée avec succès');
            return $this->redirectToRoute( 'admin.news.index');
        }

        return $this->render('admin/news/new.html.twig', [
            'news' => $news,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/news/{id}", name="admin.news.edit")
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
            $this->addFlash('success', 'Article modifié avec succès');
            return $this->redirectToRoute( 'admin.news.index');
        }

        return $this->render('admin/news/edit.html.twig', [
            'news' => $news,
            'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/admin/news/{id}", name="admin.news.delete", methods="DELETE")
     * @param News $news
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(News $news, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $news->getId(), $request->get(_token))) {
            $this->em->remove($news);
            $this->em->flush();

            return $this->redirectToRoute('admin.news.index');
        }
    }

}
