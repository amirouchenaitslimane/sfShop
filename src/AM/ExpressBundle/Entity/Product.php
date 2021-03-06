<?php

namespace AM\ExpressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AM\ExpressBundle\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;


    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     *
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="descount", type="integer", nullable=true)
     */
    private $descount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;
    /**
     * @var
     * @ORM\OneToOne(targetEntity="AM\ExpressBundle\Entity\Image", cascade={"persist"})
     */
    private $image;


    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AM\ExpressBundle\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

public function __construct()
{
    $this->createdAt = new \DateTime();
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set descount
     *
     * @param integer $descount
     *
     * @return Product
     */
    public function setDescount($descount)
    {
        $this->descount = $descount;

        return $this;
    }

    /**
     * Get descount
     *
     * @return integer
     */
    public function getDescount()
    {
        return $this->descount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Product
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set image
     *
     * @param \AM\ExpressBundle\Entity\Image $image
     *
     * @return Product
     */
    public function setImage(\AM\ExpressBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \AM\ExpressBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set category
     *
     * @param \AM\ExpressBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\AM\ExpressBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AM\ExpressBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
