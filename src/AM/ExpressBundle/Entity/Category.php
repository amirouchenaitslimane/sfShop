<?php

namespace AM\ExpressBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AM\ExpressBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="AM\ExpressBundle\Entity\Product", mappedBy="category")
     */
    private $products;

    /**
     * @var category
     *
     * @ORM\OneToMany(targetEntity="category", mappedBy="parent")
     */
    private $children;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToOne(targetEntity="category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;



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
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();

        $this->children = new ArrayCollection();
    }

    /**
     * To String
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
    }


    /**
     * Add product
     *
     * @param \AM\ExpressBundle\Entity\Product $product
     *
     * @return Category
     */
    public function addProduct(\AM\ExpressBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \AM\ExpressBundle\Entity\Product $product
     */
    public function removeProduct(\AM\ExpressBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }


    public function setChildren($children) { //this will be an array collection so please pay attention
        $this->children = $children;

        return $this;
    }

    public function getChildren() {
        return $this->children;
    }

    /**
     * Add child
     *
     * @param \AM\ExpressBundle\Entity\category $child
     *
     * @return Category
     */
    public function addChild(\AM\ExpressBundle\Entity\category $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AM\ExpressBundle\Entity\category $child
     */
    public function removeChild(\AM\ExpressBundle\Entity\category $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Set parent
     *
     * @param \AM\ExpressBundle\Entity\category $parent
     *
     * @return Category
     */
    public function setParent(\AM\ExpressBundle\Entity\category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AM\ExpressBundle\Entity\category
     */
    public function getParent()
    {
        return $this->parent;
    }
}
