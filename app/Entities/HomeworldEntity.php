<?php


namespace App\Entities;


class HomeworldEntity
{
    private ?int $id;
    private string $name;
    private int $rotation_period;
    private int $orbital_period;
    private int $diameter;
    private string $climate;
    private string $gravity;
    private string $terrain;
    private string $surface_water;
    private string $population;
    private string $url;
    private string $created_at;
    private string $updated_at;

    /**
     * HomeworldEntity constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->id = $parameters['id'];
        $this->name = $parameters['name'];
        $this->rotation_period = $parameters['rotation_period'];
        $this->orbital_period = $parameters['orbital_period'];
        $this->diameter = $parameters['diameter'];
        $this->climate = $parameters['climate'];
        $this->gravity = $parameters['gravity'];
        $this->terrain = $parameters['terrain'];
        $this->surface_water = $parameters['surface_water'];
        $this->population = $parameters['population'];
        $this->url = $parameters['url'];
        $this->created_at = $parameters['created_at'];
        $this->updated_at = $parameters['updated_at'];
    }

    /**
     * Gets HomeworldEntity's id
     *
     * @return int|mixed|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets HomeworldEntity's name
     *
     * @return mixed|string
     */
    public function getName()
    {
        return $this->name;
    }
}
