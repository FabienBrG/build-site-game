<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Site\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    public function indexAction()
    {
		$em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('SiteNewsBundle:News')->findAll();

        return $this->render('SiteNewsBundle:Default:index.html.twig', array('news' => $news));
    }
}