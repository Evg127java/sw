<?php


namespace App\Entities;


use DateTime;

class HomeworldEntity
{
    public ?int $id;
    public string $name;
    public int $rotation_period;
    public int $orbital_period;
    public int $diameter;
    public string $climate;
    public string $gravity;
    public string $terrain;
    public string $surface_water;
    public string $population;
    public string $url;
    public DateTime $created_at;
    public DateTime $updated_at;

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


}
