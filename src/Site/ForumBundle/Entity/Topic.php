<?php

namespace Site\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Site\ForumBundle\Repository\TopicRepository")
 */
class Topic
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
     * @ORM\Column(name="titre", type="string", length=100)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_last_reply", type="datetime")
     */
    private $dateLastReply;

    /**
     * @ORM\ManyToOne(targetEntity="SubForum", inversedBy="listTopic", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $fk_subForum;

    /**
     * @ORM\ManyToOne(targetEntity="Site\ForumBundle\Entity\Auteur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fk_auteur;

	 /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="fk_topic", cascade={"remove", "persist"})
     */
    private $listComment;

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
     * Set titre
     *
     * @param string $titre
     * @return Topic
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Topic
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set fk_subForum
     *
     * @param \Site\ForumBundle\Entity\SubForum $fkSubForum
     * @return Topic
     */
    public function setFkSubForum(\Site\ForumBundle\Entity\SubForum $fkSubForum)
    {
        $this->fk_subForum = $fkSubForum;

        return $this;
    }

    /**
     * Get fk_subForum
     *
     * @return \Site\ForumBundle\Entity\SubForum
     */
    public function getFkSubForum()
    {
        return $this->fk_subForum;
    }

    /**
     * Set fk_auteur
     *
     * @param \Site\ForumBundle\Entity\Auteur $fkAuteur
     * @return Topic
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

    /**
     * Set dateLastReply
     *
     * @param \DateTime $dateLastReply
     * @return Topic
     */
    public function setDateLastReply($dateLastReply)
    {
        $this->dateLastReply = $dateLastReply;

        return $this;
    }

    /**
     * Get dateLastReply
     *
     * @return \DateTime
     */
    public function getDateLastReply()
    {
        return $this->dateLastReply;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->listComment = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add listComment
     *
     * @param \Site\ForumBundle\Entity\Topic $listComment
     * @return Topic
     */
    public function addListComment(\Site\ForumBundle\Entity\Topic $listComment)
    {
        $this->listComment[] = $listComment;

        return $this;
    }

    /**
     * Remove listComment
     *
     * @param \Site\ForumBundle\Entity\Topic $listComment
     */
    public function removeListComment(\Site\ForumBundle\Entity\Topic $listComment)
    {
        $this->listComment->removeElement($listComment);
    }

    /**
     * Get listComment
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListComment()
    {
        return $this->listComment;
    }
}
