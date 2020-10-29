<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends AbstractController
{

    private $articleRepository;

    public function __construct(ArticlesRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }
    /**
     * @Route("/articles", name="articles")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ArticlesController.php',
        ]);
    }

    /**
     * @Route("/articles/create", name="articles", methods={"POST"})
     */
    public function create(Request $request):JsonResponse {

        $articleTitle = $request->get('article_title');
        $articleBody = $request->get('article_body');

        $this->articleRepository->saveArticle($articleTitle, $articleBody);
        return new JsonResponse('Success',200);
    }
}
