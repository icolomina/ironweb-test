<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/api", defaults={"_format": "json"})
 */
class ApiController extends BaseApiController
{
    /**
     * @Route("/article/create", name="api_article_create")
     * @Method({"POST"})
     */
    public function createArticleAction(Request $request){

        $this->validateInputData($request->request->all(), 'create');

        $text = $request->request->get('text');
        $title = $request->request->get('title');
        $desc = $request->request->get('description');

        $article = $this->getDoctrine()->getRepository('AppBundle:Article')->createArticle($this->getEmail(), $title, $text, $desc);
        return $this->createApiResponse(
            $this->get('jms_serializer')->serialize($article, 'json', SerializationContext::create()->setGroups('created'))
        );

    }

    /**
     * @Route("/article/{aid}/answer", name="api_article_answer")
     * @ParamConverter("article", class="AppBundle:Article", options={"id" = "aid"})
     *
     * @Method({"POST"})
     */
    public function answerArticleAction(Request $request, Article $article){

        $this->validateInputData($request->request->all(), 'answer');
        $answer = $request->request->get('answer');

        $answer = $this->getDoctrine()->getRepository('AppBundle:Article')->createAnswer($article, $answer, $this->getEmail());
        return $this->createApiResponse(
            $this->get('jms_serializer')->serialize($answer, 'json', SerializationContext::create()->setGroups('answered'))
        );
    }

    /**
     * @Route("/article/{aid}/rate", name="api_article_rate")
     * @ParamConverter("article", class="AppBundle:Article", options={"id" = "aid"})
     *
     * @Method({"POST"})
     */
    public function rateArticleAction(Request $request, Article $article){

        $this->validateInputData($request->request->all(), 'rate');
        $value = $request->request->get('rate');

        $answer = $this->getDoctrine()->getRepository('AppBundle:Article')->rate($article, $value, $this->getEmail());
        return $this->createApiResponse(
            $this->get('jms_serializer')->serialize($answer, 'json', SerializationContext::create()->setGroups('rated'))
        );
    }

    /**
     * @Route("/article/{aid}/get", name="api_article_get")
     * @ParamConverter("article", class="AppBundle:Article", options={"id" = "aid"})
     *
     * @Method({"GET"})
     */
    public function getArticleAction(Article $article){

        return $this->createApiResponse(
            $this->get('jms_serializer')->serialize($article, 'json', SerializationContext::create()->setGroups('shown'))
        );
    }

}