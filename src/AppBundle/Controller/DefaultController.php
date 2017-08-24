<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * @Route("/")
 */

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM AppBundle:Article a order by a.createdAt ASC ";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        // parameters to template
      return $this->render('AppBundle:Default:index.html.twig', array('pagination' => $pagination));
      //  return $this->render('AppBundle:Default:index.html.twig', array('pagination' => $pagination));


    }

     /**
      * @Route("/article/{id}", name="blog_home_show_article")
      */
    public function presentationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Article')->find($id);

        if (!$article) throw $this->createNotFoundException('La page n\'existe pas.');


        return $this->render('AppBundle:Default:presentation.html.twig', array('article' => $article));
    }




}
