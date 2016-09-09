<?php

namespace Rumguru\Model\Entities;

use Nette\Utils\DateTime;

class Rum
{

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $image;

    /** @var string */
    private $description;

    /** @var int */
    private $brand_id;

    /** @var int */
    private $country_id;

    /** @var int */
    private $type;

    /** @var int */
    private $priceFrom;

    /** @var int */
    private $priceTo;

    /** @var int */
    private $age;

    /** @var int */
    private $alcohol;

    /** @var string */
    private $color;

    /** @var float */
    private $score;

    /** @var \DateTime|Null */
    private $validated;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * @param int $brand_id
     */
    public function setBrandId($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    /**
     * @return int
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * @param int $country_id
     */
    public function setCountryId($country_id)
    {
        $this->country_id = $country_id;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getPriceFrom()
    {
        return $this->priceFrom;
    }

    /**
     * @param int $priceFrom
     */
    public function setPriceFrom($priceFrom)
    {
        $this->priceFrom = $priceFrom;
    }

    /**
     * @return int
     */
    public function getPriceTo()
    {
        return $this->priceTo;
    }

    /**
     * @param int $priceTo
     */
    public function setPriceTo($priceTo)
    {
        $this->priceTo = $priceTo;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return int
     */
    public function getAlcohol()
    {
        return $this->alcohol;
    }

    /**
     * @param int $alcohol
     */
    public function setAlcohol($alcohol)
    {
        $this->alcohol = $alcohol;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param float $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return \DateTime|Null
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * @param \DateTime|Null $validated
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;
    }


}