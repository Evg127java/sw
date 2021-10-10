<?php


namespace App\Entities;


class FilmEntity
{
    private ?int $id;
    private string $title;
    private int $episode_id;
    private string $opening_crawl;
    private string $director;
    private string $producer;
    private string $release_date;
    private string $url;
    private string $created_at;
    private string $updated_at;

    /**
     * FilmEntity constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->id = $parameters['id'];
        $this->title = $parameters['title'];
        $this->episode_id = $parameters['episode_id'];;
        $this->opening_crawl = $parameters['opening_crawl'];
        $this->director = $parameters['director'];
        $this->producer = $parameters['producer'];
        $this->release_date = $parameters['release_date'];
        $this->url = $parameters['url'];
        $this->created_at = $parameters['created_at'];
        $this->updated_at = $parameters['updated_at'];
    }

    /**
     * Gets FilmEntity's id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets FilmEntity's id
     *
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * Gets FilmEntity's title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Gets FilmEntity's url
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }
}
