<?php


namespace App\Entities;


class GenderEntity
{
    private ?int $id;
    private string $type;
    private string $created_at;
    private string $updated_at;

    /**
     * GenderEntity constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->id = $parameters['id'];
        $this->created_at = $parameters['created_at'];
        $this->updated_at = $parameters['updated_at'];
        $this->type = $parameters['type'];
    }

    /**
     * Gets GenderEntity's id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets GenderEntity's id
     *
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * Gets GenderEntity's type
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets GenderEntity's id
     *
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }
}
