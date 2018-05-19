<?php

namespace AM\ExpressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Command
 *
 * @ORM\Table(name="command")
 * @ORM\Entity(repositoryClass="AM\ExpressBundle\Repository\CommandRepository")
 */
class Command
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
     * @ORM\ManyToOne(targetEntity="AM\UserBundle\Entity\User", inversedBy="commande")
     * @ORM\JoinColumn(nullable=true)
     */

    private $user;
    /**
     * @var boolean
     *
     * @ORM\Column(name="valider", type="boolean")
     */
    private $valider;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    /**
     * @var integer
     *
     * @ORM\Column(name="reference", type="integer")
     */
    private $reference;
    /**
     * @var array
     *
     * @ORM\Column(name="produits", type="array")
     */
    private $products;



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
     * Set valider
     *
     * @param boolean $valider
     *
     * @return Command
     */
    public function setValider($valider)
    {
        $this->valider = $valider;

        return $this;
    }

    /**
     * Get valider
     *
     * @return boolean
     */
    public function getValider()
    {
        return $this->valider;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Command
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reference
     *
     * @param integer $reference
     *
     * @return Command
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return integer
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set products
     *
     * @param array $products
     *
     * @return Command
     */
    public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * Get products
     *
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set user
     *
     * @param \AM\UserBundle\Entity\User $user
     *
     * @return Command
     */
    public function setUser(\AM\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AM\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
