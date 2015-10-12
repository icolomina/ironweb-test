<?php

namespace AppBundle\Tests;


use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleAnswer;
use AppBundle\Entity\ArticleRate;

class ArticleRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testCreateArticle(){

        $article = new Article();
        $article->setEmail('user@email.com');
        $article->setText('a text');
        $article->setDescription('A desc');
        $article->setTitle('A title');

        $employeeRepository = $this->getMockBuilder('\AppBundle\Repository\ArticleRepository')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $employeeRepository->expects($this->once())
            ->method('createArticle')
            ->will($this->returnValue($article));

        $result = $employeeRepository->createArticle('user@email.com', 'A title', 'a text', 'A desc');
        $this->assertInstanceOf('AppBundle\Entity\Article', $result);
    }

    /**
     *
     */
    public function testAnswerArticle(){

        $article = new Article();
        $article->setEmail('user@email.com');
        $article->setText('a text');
        $article->setDescription('A desc');
        $article->setTitle('A title');

        $answer = new ArticleAnswer();
        $answer->setEmail('otheruser@email.com');
        $answer->setText('an answer text');
        $answer->setArticle($article);

        $article->addAnswer($answer);

        $employeeRepository = $this->getMockBuilder('\AppBundle\Repository\ArticleRepository')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $employeeRepository->expects($this->once())
            ->method('createAnswer')
            ->will($this->returnValue($answer));

        $result = $employeeRepository->createAnswer($article, 'an answer text', 'user@email.com');
        $this->assertInstanceOf('AppBundle\Entity\ArticleAnswer', $result);
    }

    /**
     *
     */
    public function testRateArticle(){

        $article = new Article();
        $article->setEmail('andother@email.com');
        $article->setText('a text');
        $article->setDescription('A desc');
        $article->setTitle('A title');

        $rate = new ArticleRate();
        $rate->setEmail('otheruser@email.com');
        $rate->setRate(4);
        $rate->setArticle($article);

        $article->addRate($rate);

        $employeeRepository = $this->getMockBuilder('\AppBundle\Repository\ArticleRepository')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $employeeRepository->expects($this->once())
            ->method('rate')
            ->will($this->returnValue($rate));

        $result = $employeeRepository->rate($article, 4, 'andother@email.com');
        $this->assertInstanceOf('AppBundle\Entity\ArticleRate', $result);
    }
}