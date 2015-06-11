<?php

namespace Site\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forum
 *
 * @ORM\Table(name="forum")
 * @ORM\Entity(repositoryClass="Site\ForumBundle\Repository\ForumRepository")
 */
class Forum
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
     * @ORM\OneToMany(targetEntity="SubForum", mappedBy="fk_forum", cascade={"remove", "persist"})
     */
    private $listSubForum;

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
     * @return Forum
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
     * Constructor
     */
    public function __construct()
    {
        $this->listSubForum = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add listSubForum
     *
     * @param \Site\ForumBundle\Entity\DeskComment $listSubForum
     * @return Forum
     */
    public function addListSubForum(\Site\ForumBundle\Entity\SubForum $listSubForum)
    {
        $this->listSubForum[] = $listSubForum;

        return $this;
    }

    /**
     * Remove listSubForum
     *
     * @param \Site\ForumBundle\Entity\DeskComment $listSubForum
     */
    public function removeListSubForum(\Site\ForumBundle\Entity\SubForum $listSubForum)
    {
        $this->listSubForum->removeElement($listSubForum);
    }

    /**
     * Get listSubForum
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListSubForum()
    {
        return $this->listSubForum;
    }
}
