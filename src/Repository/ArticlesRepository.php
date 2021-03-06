<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        
        parent::__construct($registry, Articles::class);
        $this->manager = $manager;
    }
    public function saveArticle($articleTitle, $articleBody, $isActive)
    {
        $article = new Articles();
        $article
            ->setArticleCreated(new \DateTime())
            ->setArticlePublished(new \DateTime())
            ->setArticleTitle($articleTitle)
            ->setArticleBody($articleBody)
            ->setArticleActive($isActive ? 1 : 0);

        $this->manager->persist($article);
        $this->manager->flush();
    }
    public function getAllArticles($articles)
    {
        $data = array();
        foreach ($articles ?? [] as $article) {
            $data[] = [
                'id' => $article->getId(),
                'article_created' => $article->getArticleCreated(),
                'article_published' => $article->getArticlePublished(),
                'article_title' => $article->getArticleTitle(),
                'article_body' => $article->getArticleBody(),
                'article_active' => $article->getArticleActive(),

            ];
        }
        return $data;
    }
    // /**
    //  * @return Articles[] Returns an array of Articles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Articles
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
