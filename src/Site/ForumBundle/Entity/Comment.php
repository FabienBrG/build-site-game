<?php

namespace Site\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Site\ForumBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publication", type="datetime")
     */
    private $datePublication;
    
    /**
     * @ORM\ManyToOne(targetEntity="Site\ForumBundle\Entity\Topic")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fk_topic;

    /**
     * @ORM\ManyToOne(targetEntity="Site\ForumBundle\Entity\Auteur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fk_auteur;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Comment
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     * @return Comment
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set fk_topic
     *
     * @param \Site\ForumBundle\Entity\Topic $fkTopic
     * @return Comment
     */
    public function setFkTopic(\Site\ForumBundle\Entity\Topic $fkTopic)
    {
        $this->fk_topic = $fkTopic;

        return $this;
    }

    /**
     * Get fk_topic
     *
     * @return \Site\ForumBundle\Entity\Topic 
     */
    public function getFkTopic()
    {
        return $this->fk_topic;
    }

    /**
     * Set fk_auteur
     *
     * @param \Site\ForumBundle\Entity\Auteur $fkAuteur
     * @return Comment
     */
    public function setFkAuteur(\Site\ForumBundle\Entity\Auteur $fkAuteur)
    {
        $this->fk_auteur = $fkAuteur;

        return $this;
    }

    /**
     * Get fk_auteur
     *
     * @return \Site\ForumBundle\Entity\Auteur 
     */
    public function getFkAuteur()
    {
        return $this->fk_auteur;
    }
}
