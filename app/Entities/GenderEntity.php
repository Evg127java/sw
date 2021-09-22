<?php


namespace App\Entities;


use DateTime;

class GenderEntity
{
    public ?int $id;
    public string $type;
    public DateTime $created_at;
    public DateTime $updated_at;

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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }


}
