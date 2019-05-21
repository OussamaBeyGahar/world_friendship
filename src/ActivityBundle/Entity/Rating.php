<?php

namespace ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="rating", indexes={@ORM\Index(name="idact", columns={"idact"})})
 * @ORM\Entity
 */
class Rating
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="security", type="integer", nullable=false)
     */
    private $security;

    /**
     * @var integer
     *
     * @ORM\Column(name="beauty", type="integer", nullable=false)
     */
    private $beauty;

    /**
     * @var integer
     *
     * @ORM\Column(name="budget", type="integer", nullable=false)
     */
    private $budget;

    /**
     * @var \Activity
     *
     * @ORM\ManyToOne(targetEntity="Activity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idact", referencedColumnName="id")
     * })
     */
    private $idact;

    /**
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     */
    private $iduser;




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
     * Set security
     *
     * @param integer $security
     *
     * @return Rating
     */
    public function setSecurity($security)
    {
        $this->security = $security;

        return $this;
    }

    /**
     * Get security
     *
     * @return integer
     */
    public function getSecurity()
    {
        return $this->security;
    }

    /**
     * Set beauty
     *
     * @param integer $beauty
     *
     * @return Rating
     */
    public function setBeauty($beauty)
    {
        $this->beauty = $beauty;

        return $this;
    }

    /**
     * Get beauty
     *
     * @return integer
     */
    public function getBeauty()
    {
        return $this->beauty;
    }

    /**
     * Set budget
     *
     * @param integer $budget
     *
     * @return Rating
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return integer
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set idact
     *
     * @param \ActivityBundle\Entity\Activity $idact
     *
     * @return Rating
     */
    public function setIdact(\ActivityBundle\Entity\Activity $idact = null)
    {
        $this->idact = $idact;

        return $this;
    }

    /**
     * Get idact
     *
     * @return \ActivityBundle\Entity\Activity
     */
    public function getIdact()
    {
        return $this->idact;
    }

    /**
     * Set iduser
     *
     * @param \ActivityBundle\Entity\User $iduser
     *
     * @return Rating
     */
    public function setIduser(\ActivityBundle\Entity\User $iduser = null)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return \ActivityBundle\Entity\User
     */
    public function getIduser()
    {
        return $this->iduser;
    }
}
