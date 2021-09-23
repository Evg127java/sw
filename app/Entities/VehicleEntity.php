<?php


namespace App\Entities;


class VehicleEntity
{
    public ?int $id;
    public string $name;
    public string $model;
    public string $manufacturer;
    public int $cost_in_credits;
    public float $length;
    public int $max_atmosphering_speed;
    public string $passengers;
    public string $crew;
    public int $cargo_capacity;
    public string $consumables;
    public string $vehicle_class;
    public string $url;
    public string $created_at;
    public string $updated_at;

    /**
     * StarshipEntity constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->id = $parameters['id'];
        $this->name = $parameters['name'];
        $this->model = $parameters['model'];
        $this->manufacturer = $parameters['manufacturer'];
        $this->cost_in_credits = $parameters['cost_in_credits'];
        $this->length = $parameters['length'];
        $this->max_atmosphering_speed = $parameters['max_atmosphering_speed'];
        $this->passengers = $parameters['passengers'];
        $this->crew = $parameters['crew'];
        $this->cargo_capacity = $parameters['cargo_capacity'];
        $this->consumables = $parameters['consumables'];
        $this->vehicle_class = $parameters['vehicle_class'];
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
}
