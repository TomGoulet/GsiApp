<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;



/**
 * Class NewsController
 * @package App\Controller
 */
class NewsController extends AbstractController
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
     * NewsController constructor.
     * @param NewsRepository $repository
     * @param ObjectManager $em
     */
    public function __construct(NewsRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/Actualités", name="news.index")
     * @return Response
     */

    public function index(NewsRepository $repository): Response
    {
        $results = $repository->findByOrder();
        $this->em->flush();
        return $this->render('pages/news/index.html.twig', [
            'results' => $results]);
    }


    /**
     * @Route("/Actualités/{slug}-{id}", name="news.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param News $news
     * @return Response
     */
    public function show(News $news, string $slug): Response
    {
        if ($news->getSlug() !== $slug) {
            $this->redirectToRoute('news.show', [
                'news' => $news->getId()
            ],  301);
        }
        return $this->render('pages/news/show.html.twig', [
            'news' => $news
        ]);
    }

}