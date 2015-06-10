<?php

namespace Site\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ForumController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $forums = $em->getRepository('SiteForumBundle:Forum')->findAll();
                
        return $this->render('SiteForumBundle:Forum:forum.html.twig', 
                             array('forums' => $forums));
    }
}
