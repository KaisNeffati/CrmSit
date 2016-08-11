<?php

namespace SIT\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="SIT\PlatformBundle\Repository\ProduitRepository")
 */
class produit
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
     * @ORM\ManyToOne(targetEntity="SIT\PlatformBundle\Entity\societe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $societe;

    /**
     * @return mixed
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * @param mixed $societe
     */
    public function setSociete($societe)
    {
        $this->societe = $societe;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="Status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="periodeLivraison", type="string", length=255)
     */
    private $periodeLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="type_d_installation", type="string", length=255)
     */
    private $typeDInstallation;

    /**
     * @var int
     *
     * @ORM\Column(name="budget", type="integer")
     */
    private $budget;


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
     * Set status
     *
     * @param string $status
     *
     * @return Produit
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set periodeLivraison
     *
     * @param string $periodeLivraison
     *
     * @return Produit
     */
    public function setPeriodeLivraison($periodeLivraison)
    {
        $this->periodeLivraison = $periodeLivraison;

        return $this;
    }

    /**
     * Get periodeLivraison
     *
     * @return string
     */
    public function getPeriodeLivraison()
    {
        return $this->periodeLivraison;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Produit
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set typeDInstallation
     *
     * @param string $typeDInstallation
     *
     * @return Produit
     */
    public function setTypeDInstallation($typeDInstallation)
    {
        $this->typeDInstallation = $typeDInstallation;

        return $this;
    }

    /**
     * Get typeDInstallation
     *
     * @return string
     */
    public function getTypeDInstallation()
    {
        return $this->typeDInstallation;
    }

    /**
     * Set budget
     *
     * @param integer $budget
     *
     * @return Produit
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return int
     */
    public function getBudget()
    {
        return $this->budget;
    }
}

