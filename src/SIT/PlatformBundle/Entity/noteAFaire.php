<?php

namespace SIT\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * noteAFaire
 *
 * @ORM\Table(name="note_a_faire")
 * @ORM\Entity(repositoryClass="SIT\PlatformBundle\Repository\noteAFaireRepository")
 */
class noteAFaire extends note
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
     * @ORM\Column(name="typeDeRappelle", type="string", length=255)
     */
    private $typeDeRappelle;


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
     * Set typeDeRappelle
     *
     * @param string $typeDeRappelle
     *
     * @return noteAFaire
     */
    public function setTypeDeRappelle($typeDeRappelle)
    {
        $this->typeDeRappelle = $typeDeRappelle;

        return $this;
    }

    /**
     * Get typeDeRappelle
     *
     * @return string
     */
    public function getTypeDeRappelle()
    {
        return $this->typeDeRappelle;
    }
}

