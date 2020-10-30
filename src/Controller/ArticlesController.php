<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class ArticlesController extends AbstractController
{
    //TODO: Error handling and validation of inputs

    private $articleRepository;

    public function __construct(ArticlesRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }


    /**
     * @Route("/api/articles", name="articles", methods={"GET"})
     */
    public function showAll(): JsonResponse
    {
        $articles = $this->articleRepository->findAll();
        return new JsonResponse($this->articleRepository->getAllArticles($articles), Response::HTTP_OK);
    }

    /**
     * @Route("/api/articles/create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse {

        $article = json_decode($request->getContent(), true);
        $articleTitle = $article['article_title'];
        $articleBody = $article['article_body'];
        $articleActive = $article['isActive'];

        $this->articleRepository->saveArticle($articleTitle, $articleBody, $articleActive);

        return new JsonResponse($article,Response::HTTP_CREATED);
    }
}
