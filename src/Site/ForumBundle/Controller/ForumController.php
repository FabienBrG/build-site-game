<?php

namespace Site\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ForumController extends Controller
{
    /**
	 * Display forum homepage
	 */
	public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $forums = $em->getRepository('SiteForumBundle:Forum')->findAll();

        return $this->render('SiteForumBundle:Forum:forum.html.twig',
                             array('forums' => $forums));
    }

	/**
	 * Display subForum after homepage
	 */
	public function subForumAction($idSubForum)
    {
        $em = $this->getDoctrine()->getManager();

        $subForum = $em->getRepository('SiteForumBundle:SubForum')->findBy(array('id' => $idSubForum));

        return $this->render('SiteForumBundle:Forum:subForum.html.twig',
                             array('subForum' => $subForum[0], 'idSubForum' => $idSubForum));
    }

	/**
	 * Display topic with messages, avatars, author, date + form to reply
	 */
	public function topicAction(Request $request, $idSubForum, $idTopic)
    {
        $em = $this->getDoctrine()->getManager();

        $topic = $em->getRepository('SiteForumBundle:Topic')->findBy(array('id' => $idTopic));
		$subForum = $em->getRepository('SiteForumBundle:SubForum')->findBy(array('id' => $idSubForum));

		// ->setAction($this->generateUrl('parc_info_modifier', array('idmat' => $materiel->getId())))
		$form = $this->createFormBuilder()
			->setMethod('POST')
			->add('pseudo', 'entity', array('class' => 'SiteForumBundle:Auteur',
                  'property' => 'pseudo'))
			->add('comment','textarea',
					array('attr' => array('class'=>'tinymce','data-theme' => 'advanced')))
			->add('envoyer', 'submit')
            ->getForm();

		/**
		 * if submit comment
		 */
		if ($form->handleRequest($request)->isSubmitted()) {
            if ($form->get('envoyer')->isClicked()) {
                $data = $form->getData();

				$dateNow = new \DateTime('now');

				$comment = new \Site\ForumBundle\Entity\Comment();

				$comment->setContenu($data['comment']);
				$comment->setFkAuteur($data['pseudo']);
				$comment->setDatePublication($dateNow);
				\Doctrine\Common\Util\Debug::dump($topic);
				$comment->setFkTopic($topic[0]);

				$topic[0]->setDateLastReply($dateNow);

				$em->persist($comment);
				$em->flush();

				return $this->redirect($this->generateUrl('site_forum_topic',array('idSubForum' => $idSubForum, 'idTopic' => $idTopic)));
			}
		}

        return $this->render('SiteForumBundle:Forum:topic.html.twig',
                             array('topic' => $topic[0], 'idSubForum' => $idSubForum, 'subForum' => $subForum[0], 'form' => $form->createView()));
    }

	/**
	 * Create new topic
	 */
	public function createTopicAction(Request $request, $idSubForum)
    {
        $em = $this->getDoctrine()->getManager();

        $subForum = $em->getRepository('SiteForumBundle:SubForum')->findBy(array('id' => $idSubForum));

		$form = $this->createFormBuilder()
			->setMethod('POST')
			->add('pseudo', 'entity', array('class' => 'SiteForumBundle:Auteur',
                  'property' => 'pseudo'))
			->add('sujet','text')
			->add('comment','textarea',
					array('attr' => array('class'=>'tinymce','data-theme' => 'advanced')))
			->add('creer', 'submit')
            ->getForm();

		if ($form->handleRequest($request)->isSubmitted())
		{
            if ($form->get('creer')->isClicked())
			{
                $data = $form->getData();

				$dateNow = new \DateTime('now');

				$topic = new \Site\ForumBundle\Entity\Topic();

				$topic->setDateCreation($dateNow);
				$topic->setDateLastReply($dateNow);
				$topic->setTitre($data['sujet']);
				$topic->setFkAuteur($data['pseudo']);
				$topic->setFkSubForum($subForum[0]);

				$em->persist($topic);

				$comment = new \Site\ForumBundle\Entity\Comment();

				$comment->setContenu($data['comment']);
				$comment->setFkAuteur($data['pseudo']);
				$comment->setDatePublication($dateNow);
				\Doctrine\Common\Util\Debug::dump($topic);
				$comment->setFkTopic($topic);

				$em->persist($comment);

				$em->flush();

				return $this->redirect($this->generateUrl('site_forum_subforum',array('idSubForum' => $idSubForum)));
			}
		}

		return $this->render('SiteForumBundle:Forum:createTopic.html.twig',array('idSubForum' => $idSubForum,'form' => $form->createView()));
	}
}
