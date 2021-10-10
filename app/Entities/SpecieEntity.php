<?php


namespace App\Entities;


class SpecieEntity
{
    private ?int $id;
    private string $name;
    private string $classification;
    private string $designation;
    private string $average_height;
    private string $skin_colors;
    private string $hair_colors;
    private string $eye_colors;
    private string $average_lifespan;
    private int $homeworld_id;
    private string $language;
    private string $url;
    private string $created_at;
    private string $updated_at;

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
     * Gets the SpecieEntity's id
     *
     * @return int|mixed|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the SpecieEntity's id
     *
     * @param int|mixed|null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * Gets the SpecieEntity's name
     *
     * @return mixed|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the SpecieEntity's name
     *
     * @param mixed|string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * Gets the SpecieEntity's url
     *
     * @return mixed|string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
