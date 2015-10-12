<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleAnswer;
use AppBundle\Entity\ArticleRate;
use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    /**
     * @param $email
     * @param $title
     * @param $text
     * @param $desc
     */
    public function createArticle($email, $title, $text, $desc){

        $article = new Article();
        $article->setText($text);
        $article->setEmail($email);
        $article->setTitle($title);
        $article->setDescription($desc);

        $em = $this->getEntityManager();
        $em->persist($article);
        $em->flush();

        return $article;
    }

    /**
     * @param Article $article
     * @param $text
     * @param $email
     */
    public function createAnswer(Article $article, $text, $email){

        $em = $this->getEntityManager();

        $answer = new ArticleAnswer();
        $answer->setEmail($email);
        $answer->setText($text);
        $answer->setArticle($article);
        $article->addAnswer($answer);

        $em->persist($answer);
        $em->persist($article);
        $em->flush();

        return $answer;

    }

    /**
     * @param Article $article
     * @param $value
     * @param $email
     * @return ArticleRate
     */
    public function rate(Article $article, $value, $email){

        $rate = new ArticleRate();
        $rate->setEmail($email);
        $rate->setRate($value);
        $rate->setArticle($article);
        $article->addRate($rate);

        $em = $this->getEntityManager();
        $em->persist($rate);
        $em->persist($article);
        $em->flush();

        return $rate;


    }
}