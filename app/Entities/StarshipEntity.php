<?php


namespace App\Entities;


class StarshipEntity
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
    private float $hyperdrive_rating;
    private int $mglt;
    private string $starship_class;
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
        $this->hyperdrive_rating = $parameters['hyperdrive_rating'];
        $this->mglt = $parameters['mglt'];
        $this->starship_class = $parameters['starship_class'];
        $this->url = $parameters['url'];
        $this->created_at = $parameters['created_at'];
        $this->updated_at = $parameters['updated_at'];
    }

    /**
     * Gets the StarshipEntity's id
     *
     * @return int|mixed|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the StarshipEntity's name
     *
     * @return mixed|string
     */
    public function getName()
    {
        return $this->name;
    }


}
