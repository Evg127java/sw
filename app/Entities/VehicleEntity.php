<?php


namespace App\Entities;


class VehicleEntity
{
    private ?int $id;
    private string $name;
    private string $model;
    private string $manufacturer;
    private int $cost_in_credits;
    private float $length;
    private int $max_atmosphering_speed;
    private string $passengers;
    private string $crew;
    private int $cargo_capacity;
    private string $consumables;
    private string $vehicle_class;
    private string $url;
    private string $created_at;
    private string $updated_at;

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
     * Gets the VehicleEntity's id
     *
     * @return int|mixed|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the VehicleEntity's name
     *
     * @return mixed|string
     */
    public function getName()
    {
        return $this->name;
    }

}
