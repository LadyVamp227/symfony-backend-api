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
        $articles = $this->articleRepository->findBy(array(),array('article_id'=>'desc'));
        return new JsonResponse($this->articleRepository->getAllArticles($articles), Response::HTTP_OK);
    }

    /**
     * @Route("/api/articles/create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse {
        $article = json_decode($request->getContent(), true);
        $response = "Bad Request";
        $status = Response::HTTP_BAD_REQUEST;
        if (!empty($article['article_title']) and !empty($article['article_body']) and !empty($article['isActive'])) {
            $this->articleRepository->saveArticle($article['article_title'], $article['article_body'], $article['isActive']);
            $response = "Success";
            $status = Response::HTTP_CREATED;
        }
        return new JsonResponse($response,$status);
    }
}
