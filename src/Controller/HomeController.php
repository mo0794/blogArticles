<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticlesRepository;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ArticlesRepository $articlesRepository): Response
    {
        $articles = $articlesRepository->getArticles(3);
        return $this->render('home/index.html.twig' ,[
            'articles' => $articlesRepository->findAll(),
        ]);
    }
}
