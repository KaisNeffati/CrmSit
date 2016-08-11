<?php

namespace SIT\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * societe
 *
 * @ORM\Table(name="societe")
 * @ORM\Entity(repositoryClass="SIT\PlatformBundle\Repository\societeRepository")
 */
class societe
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer")
     */
    private $tel;

    /**
     * @var int
     *
     * @ORM\Column(name="fax", type="integer")
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return societe
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     *
     * @return societe
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return int
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set fax
     *
     * @param integer $fax
     *
     * @return societe
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return int
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return societe
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}

