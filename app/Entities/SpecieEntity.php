<?php


namespace App\Entities;


class SpecieEntity
{
    public ?int $id;
    public string $name;
    public string $classification;
    public string $designation;
    public string $average_height;
    public string $skin_colors;
    public string $hair_colors;
    public string $eye_colors;
    public string $average_lifespan;
    public int $homeworld_id;
    public string $language;
    public string $url;
    public string $created_at;
    public string $updated_at;

    /**
     * SpecieEntity constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->id = $parameters['id'];
        $this->name = $parameters['name'];
        $this->classification = $parameters['classification'];
        $this->designation = $parameters['designation'];
        $this->average_height = $parameters['average_height'];
        $this->skin_colors = $parameters['skin_colors'];
        $this->hair_colors = $parameters['hair_colors'];
        $this->eye_colors = $parameters['eye_colors'];
        $this->average_lifespan = $parameters['average_lifespan'];
        $this->homeworld_id = $parameters['homeworld_id'];
        $this->language = $parameters['language'];
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
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * @param mixed|string $classification
     */
    public function setClassification($classification): void
    {
        $this->classification = $classification;
    }

    /**
     * @return mixed|string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param mixed|string $designation
     */
    public function setDesignation($designation): void
    {
        $this->designation = $designation;
    }

    /**
     * @return mixed|string
     */
    public function getAverageHeight()
    {
        return $this->average_height;
    }

    /**
     * @param mixed|string $average_height
     */
    public function setAverageHeight($average_height): void
    {
        $this->average_height = $average_height;
    }

    /**
     * @return mixed|string
     */
    public function getSkinColors()
    {
        return $this->skin_colors;
    }

    /**
     * @param mixed|string $skin_colors
     */
    public function setSkinColors($skin_colors): void
    {
        $this->skin_colors = $skin_colors;
    }

    /**
     * @return mixed|string
     */
    public function getHairColors()
    {
        return $this->hair_colors;
    }

    /**
     * @param mixed|string $hair_colors
     */
    public function setHairColors($hair_colors): void
    {
        $this->hair_colors = $hair_colors;
    }

    /**
     * @return mixed|string
     */
    public function getEyeColors()
    {
        return $this->eye_colors;
    }

    /**
     * @param mixed|string $eye_colors
     */
    public function setEyeColors($eye_colors): void
    {
        $this->eye_colors = $eye_colors;
    }

    /**
     * @return mixed|string
     */
    public function getAverageLifespan()
    {
        return $this->average_lifespan;
    }

    /**
     * @param mixed|string $average_lifespan
     */
    public function setAverageLifespan($average_lifespan): void
    {
        $this->average_lifespan = $average_lifespan;
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
     * @return mixed|string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed|string $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
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
     * @return mixed|string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed|string $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed|string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed|string $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }


}
