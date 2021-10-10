<?php


namespace App\Entities;


use App\Models\Image;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Services\PersonFilmsHandler;
use App\Services\PersonImagesHandler;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Storage;

class PersonEntity
{
    private ?int $id;
    private string $name;
    private string $height;
    private string $mass;
    private string $hair_color;
    private ?string $skin_color;
    private ?string $eye_color;
    private string $birth_year;
    private ?int $gender_id;
    private ?int $homeworld_id;
    private string $url;
    private ?string $created_at;
    private ?string $updated_at;
    private array $films;
    private array $images;
    private ?string $gender = null;
    private ?string $homeworld = null;

    /**
     * PersonEntity constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->id = $parameters['id'] ?? null;
        $this->name = $parameters['name'];
        $this->height = $parameters['height'];
        $this->mass = $parameters['mass'];
        $this->hair_color = $parameters['hair_color'];
        $this->skin_color = $parameters['skin_color'] ?? null;
        $this->eye_color = $parameters['eye_color'] ?? null;
        $this->birth_year = $parameters['birth_year'];
        $this->gender_id = $parameters['gender_id'];
        $this->homeworld_id = $parameters['homeworld_id'];
        $this->url = $parameters['url'];
        $this->created_at = $parameters['created_at'] ?? null;
        $this->updated_at = $parameters['updated_at'] ?? null;
    }

    /**
     * Gets PersonEntity's features as an array
     *
     * Looks like: ['feature' => value, ...]
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * Gets PersonEntity's id
     *
     * @return int|mixed|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets PersonEntity's id
     *
     * @param int|mixed|null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * Gets PersonEntity's name
     *
     * @return mixed|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets PersonEntity's name
     *
     * @param mixed|string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * Gets PersonEntity's height
     *
     * @return mixed|string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets PersonEntity's height
     *
     * @param mixed|string $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * Gets PersonEntity's weight
     *
     * @return mixed|string
     */
    public function getMass()
    {
        return $this->mass;
    }

    /**
     * Sets PersonEntity's weight
     *
     * @param mixed|string $mass
     */
    public function setMass($mass): void
    {
        $this->mass = $mass;
    }

    /**
     * Gets PersonEntity's hair color
     *
     * @return mixed|string
     */
    public function getHairColor()
    {
        return $this->hair_color;
    }

    /**
     * Sets PersonEntity's hair color
     *
     * @param mixed|string $hair_color
     */
    public function setHairColor($hair_color): void
    {
        $this->hair_color = $hair_color;
    }

    /**
     * Gets PersonEntity's skin color
     *
     * @return mixed|string
     */
    public function getSkinColor()
    {
        return $this->skin_color;
    }

    /**
     * Sets PersonEntity's skin color
     *
     * @param mixed|string $skin_color
     */
    public function setSkinColor($skin_color): void
    {
        $this->skin_color = $skin_color;
    }

    /**
     * Gets PersonEntity's eye color
     *
     * @return mixed|string
     */
    public function getEyeColor()
    {
        return $this->eye_color;
    }

    /**
     * Sets PersonEntity's eye color
     *
     * @param mixed|string $eye_color
     */
    public function setEyeColor($eye_color): void
    {
        $this->eye_color = $eye_color;
    }

    /**
     * Gets PersonEntity's birth year
     *
     * @return mixed|string
     */
    public function getBirthYear()
    {
        return $this->birth_year;
    }

    /**
     * Sets PersonEntity's birth year
     *
     * @param mixed|string $birth_year
     */
    public function setBirthYear($birth_year): void
    {
        $this->birth_year = $birth_year;
    }

    /**
     * Gets PersonEntity's gender's id
     *
     * @return int|mixed
     */
    public function getGenderId()
    {
        return $this->gender_id;
    }

    /**
     * Sets PersonEntity's gender's id
     *
     * @param int|mixed $gender_id
     */
    public function setGenderId($gender_id): void
    {
        $this->gender_id = $gender_id;
    }

    /**
     * Gets PersonEntity's homeworld's id
     *
     * @return int|mixed
     */
    public function getHomeworldId()
    {
        return $this->homeworld_id;
    }

    /**
     * Sets PersonEntity's homeworld's id
     *
     * @param int|mixed $homeworld_id
     */
    public function setHomeworldId($homeworld_id): void
    {
        $this->homeworld_id = $homeworld_id;
    }

    /**
     * Gets PersonEntity's url
     *
     * @return mixed|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets PersonEntity's url
     *
     * @param mixed|string $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * Gets PersonEntity's created date
     *
     * @return DateTime|mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Sets PersonEntity's created date
     *
     * @param DateTime|mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * Gets PersonEntity's updated date
     *
     * @return DateTime|mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Sets PersonEntity's updated date
     *
     * @param DateTime|mixed $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * Gets PersonEntity's films
     *
     * @return array
     */
    public function getFilms(): array
    {
        return $this->films;
    }

    /**
     * Sets PersonEntity's films
     *
     * @param array $films
     */
    public function setFilms(array $films): void
    {
        $this->films = $films;
    }

    /**
     * Gets PersonEntity's gender value as string
     *
     * @return string
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * Sets PersonEntity's gender value as string
     *
     * @param string|null $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * Gets PersonEntity's homeworld value as string
     *
     * @return string
     */
    public function getHomeworld(): string
    {
        return $this->homeworld;
    }

    /**
     * Sets PersonEntity's homeworld value as string
     *
     * @param string|null $homeworld
     */
    public function setHomeworld(string $homeworld): void
    {
        $this->homeworld = $homeworld;
    }

    /**
     * Gets PersonEntity's images
     *
     * @return Image[]|Builder[]|Collection
     */
    public function getImages()
    {
        return Image::where('person_id', $this->getId())->get();
    }

    /**
     * Sets PersonEntity's images
     *
     * @param array $images
     */
    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    /**
     * Updates person's with passed data
     *
     * @param array $request validated data from request
     * @return PersonEntity
     */
    public function updatePerson(array $request)
    {
        $personRepository = app(PersonRepositoryInterface::class);

        /* PersonEntity update with validated data */
        $filmsHandler = new PersonFilmsHandler($this, $request);
        $request = $filmsHandler->run();
        $imagesHandler = new PersonImagesHandler($this, $request);
        $request = $imagesHandler->run();

        /* Get person's data as an array to update */
        $dataToUpdate = array_intersect_key($request, get_object_vars($this));

        return $personRepository->updateOne($this, $dataToUpdate);
    }

    /**
     * Checks if the passed FilmEntity is belonged to the person
     * (contains in this person films' array)
     *
     * @param FilmEntity $film
     * @return bool
     */
    public function containsFilm(FilmEntity $film)
    {
        return collect($this->films)->pluck('id')->contains($film->getId());
    }

    /**
     * Deletes a person's instance by specified id
     *
     * @param int $id person's id to delete
     */
    public static function deletePersonById(int $id)
    {
        $personRepository = app(PersonRepositoryInterface::class);

        /* Delete related person's directory from the storage before the person's deleting */
        Storage::deleteDirectory('images/' . $id);

        $personRepository->deleteById($id);
    }
}
