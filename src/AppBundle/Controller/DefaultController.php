<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\Type\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="article_create")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new ArticleType());

        $form->handleRequest($request);

        if ($form->isValid()) {

            $article = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('article_created_success', array('aid' => $article->getId())));
        }

        return $this->render('AppBundle::NewArticle.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/article_created/{aid}", name="article_created_success")
     * @ParamConverter("article", class="AppBundle:Article", options={"id" = "aid"})
     */
    public function articleCreatedAction(Article $article)
    {
        return new Response("<p>Your article has been created succesfully with identifier {$article->getId()}</p>");
    }
}
