<?php

namespace MarsupilamiBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="marsupilami")
 * @ORM\Entity(repositoryClass="MarsupilamiBundle\Repository\MarsupilamiRepository")
 */
class Marsupilami extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    private  $age;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private  $famille;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private  $couleur;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private  $nourriture;

    /**
     * @ORM\ManyToMany(targetEntity="MarsupilamiBundle\Entity\Marsupilami", cascade={"persist"})
     */
    private $amis;


    public function __construct()
    {

        $this->amis = new ArrayCollection();
    }

    public function removeAmis(Marsupilami $amis)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->amis->removeElement($amis);
    }
    public function setAmis(Marsupilami $amis)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->amis[] = $amis;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getAmis()
    {
        return $this->amis;
    }

    /**
     * @param mixed $amis
     */

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * @param mixed $couleur
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    }

    /**
     * @return mixed
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * @param mixed $famille
     */
    public function setFamille($famille)
    {
        $this->famille = $famille;
    }

    /**
     * @return mixed
     */
    public function getNourriture()
    {
        return $this->nourriture;
    }

    /**
     * @param mixed $nourriture
     */
    public function setNourriture($nourriture)
    {
        $this->nourriture = $nourriture;
    }



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


}

