<?php

namespace Site\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubForum
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Site\ForumBundle\Repository\SubForumRepository")
 */
class SubForum
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="Forum", inversedBy="listSubForum", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $fk_forum;
    
     /**
     * @ORM\OneToMany(targetEntity="Topic", mappedBy="fk_subForum", cascade={"remove", "persist"})
     */
    private $listTopic;

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
     * @return SubForum
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
     * Set description
     *
     * @param string $description
     * @return SubForum
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set fk_forum
     *
     * @param \Site\ForumBundle\Entity\Forum $fkForum
     * @return SubForum
     */
    public function setFkForum(\Site\ForumBundle\Entity\Forum $fkForum)
    {
        $this->fk_forum = $fkForum;

        return $this;
    }

    /**
     * Get fk_forum
     *
     * @return \Site\ForumBundle\Entity\Forum 
     */
    public function getFkForum()
    {
        return $this->fk_forum;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->listTopic = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add listTopic
     *
     * @param \Site\ForumBundle\Entity\Topic $listTopic
     * @return SubForum
     */
    public function addListTopic(\Site\ForumBundle\Entity\Topic $listTopic)
    {
        $this->listTopic[] = $listTopic;

        return $this;
    }

    /**
     * Remove listTopic
     *
     * @param \Site\ForumBundle\Entity\Topic $listTopic
     */
    public function removeListTopic(\Site\ForumBundle\Entity\Topic $listTopic)
    {
        $this->listTopic->removeElement($listTopic);
    }

    /**
     * Get listTopic
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getListTopic()
    {
        return $this->listTopic;
    }
}
