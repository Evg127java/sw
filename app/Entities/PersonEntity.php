<?php


namespace App\Entities;


use DateTime;

class PersonEntity
{
    public ?int $id;
    public string $name;
    public string $height;
    public string $mass;
    public string $hair_color;
    public string $skin_color;
    public string $eye_color;
    public string $birth_year;
    public ?int $gender_id;
    public ?int $homeworld_id;
    public ?int $specie_id;
    public string $url;
    public string $created_at;
    public string $updated_at;

    /**
     * PersonEntity constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->id = $parameters['id'];
        $this->name = $parameters['name'];
        $this->height = $parameters['height'];
        $this->mass = $parameters['mass'];
        $this->hair_color = $parameters['hair_color'];
        $this->skin_color = $parameters['skin_color'];
        $this->eye_color = $parameters['eye_color'];
        $this->birth_year = $parameters['birth_year'];
        $this->gender_id = $parameters['gender_id'];
        $this->homeworld_id = $parameters['homeworld_id'];
        $this->specie_id = $parameters['specie_id'];
        $this->url = $parameters['url'];
        $this->created_at = $parameters['created_at'];
        $this->updated_at = $parameters['updated_at'];
    }

    /**
     * @return int|mixed|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|mixed|null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed|string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed|string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed|string $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return mixed|string
     */
    public function getMass()
    {
        return $this->mass;
    }

    /**
     * @param mixed|string $mass
     */
    public function setMass($mass): void
    {
        $this->mass = $mass;
    }

    /**
     * @return mixed|string
     */
    public function getHairColor()
    {
        return $this->hair_color;
    }

    /**
     * @param mixed|string $hair_color
     */
    public function setHairColor($hair_color): void
    {
        $this->hair_color = $hair_color;
    }

    /**
     * @return mixed|string
     */
    public function getSkinColor()
    {
        return $this->skin_color;
    }

    /**
     * @param mixed|string $skin_color
     */
    public function setSkinColor($skin_color): void
    {
        $this->skin_color = $skin_color;
    }

    /**
     * @return mixed|string
     */
    public function getEyeColor()
    {
        return $this->eye_color;
    }

    /**
     * @param mixed|string $eye_color
     */
    public function setEyeColor($eye_color): void
    {
        $this->eye_color = $eye_color;
    }

    /**
     * @return mixed|string
     */
    public function getBirthYear()
    {
        return $this->birth_year;
    }

    /**
     * @param mixed|string $birth_year
     */
    public function setBirthYear($birth_year): void
    {
        $this->birth_year = $birth_year;
    }

    /**
     * @return int|mixed
     */
    public function getGenderId()
    {
        return $this->gender_id;
    }

    /**
     * @param int|mixed $gender_id
     */
    public function setGenderId($gender_id): void
    {
        $this->gender_id = $gender_id;
    }

    /**
     * @return int|mixed
     */
    public function getHomeworldId()
    {
        return $this->homeworld_id;
    }

    /**
     * @param int|mixed $homeworld_id
     */
    public function setHomeworldId($homeworld_id): void
    {
        $this->homeworld_id = $homeworld_id;
    }

    /**
     * @return int|mixed
     */
    public function getSpecieId()
    {
        return $this->specie_id;
    }

    /**
     * @param int|mixed $specie_id
     */
    public function setSpecieId($specie_id): void
    {
        $this->specie_id = $specie_id;
    }

    /**
     * @return mixed|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed|string $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return DateTime|mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param DateTime|mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return DateTime|mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param DateTime|mixed $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }


}
