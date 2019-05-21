<?php

namespace ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Deslikes
 *
 * @ORM\Table(name="deslikes")
 * @ORM\Entity(repositoryClass="ActivityBundle\Repository\DeslikesRepository")
 */
class Deslikes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Activity")
     * @ORM\JoinColumn(name="idAct", referencedColumnName="id")
     */
    private $idAct;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     */
    private $idUser;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idAct
     *
     * @param integer $idAct
     *
     * @return Deslikes
     */
    public function setIdAct($idAct)
    {
        $this->idAct = $idAct;

        return $this;
    }

    /**
     * Get idAct
     *
     * @return int
     */
    public function getIdAct()
    {
        return $this->idAct;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Deslikes
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}

