<?php

namespace Site\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ForumController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $forums = $em->getRepository('SiteForumBundle:Forum')->findAll();

        return $this->render('SiteForumBundle:Forum:forum.html.twig',
                             array('forums' => $forums));
    }

	public function subForumAction($idSubForum)
    {
        $em = $this->getDoctrine()->getManager();

        $subForums = $em->getRepository('SiteForumBundle:SubForum')->findBy(array('id' => $idSubForum));

        return $this->render('SiteForumBundle:Forum:subForum.html.twig',
                             array('subForums' => $subForums));
    }

	public function topicAction(Request $request, $idSubForum, $idTopic)
    {
        $em = $this->getDoctrine()->getManager();

        $topic= $em->getRepository('SiteForumBundle:Topic')->findBy(array('id' => $idTopic));
		$auteur = $em->getRepository('SiteForumBundle:Auteur')->findAll();

		// ->setAction($this->generateUrl('parc_info_modifier', array('idmat' => $materiel->getId())))
		$form = $this->createFormBuilder()
			->setMethod('POST')
			->add('pseudo', 'entity', array('class' => 'SiteForumBundle:Auteur',
                  'property' => 'pseudo'))
			->add('comment','textarea')
			->add('envoyer', 'submit')
            ->getForm();

		if ($form->handleRequest($request)->isSubmitted()) {
            if ($form->get('envoyer')->isClicked()) {
                $data = $form->getData();

				$comment = new \Site\ForumBundle\Entity\Comment();

				$comment->setContenu($data['comment']);
				$comment->setFkAuteur($data['pseudo']);
				$comment->setDatePublication(new \DateTime('now'));
				\Doctrine\Common\Util\Debug::dump($topic);
				$comment->setFkTopic($topic[0]);

				$em->persist($comment);
				$em->flush();

			}
		}

        return $this->render('SiteForumBundle:Forum:topic.html.twig',
                             array('topic' => $topic, 'subForum' => $idSubForum, 'form' => $form->createView()));
    }
}
