<?php


namespace App\Entities;


class FilmEntity
{
    public $id;
    public $title;
    public $episode_id;
    public $opening_crawl;
    public $director;
    public $producer;
    public $release_date;
    public $url;
    public $created_at;
    public $updated_at;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getEpisodeId()
    {
        return $this->episode_id;
    }

    /**
     * @param mixed $episode_id
     */
    public function setEpisodeId($episode_id): void
    {
        $this->episode_id = $episode_id;
    }

    /**
     * @return mixed
     */
    public function getOpeningCrawl()
    {
        return $this->opening_crawl;
    }

    /**
     * @param mixed $opening_crawl
     */
    public function setOpeningCrawl($opening_crawl): void
    {
        $this->opening_crawl = $opening_crawl;
    }

    /**
     * @return mixed
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param mixed $director
     */
    public function setDirector($director): void
    {
        $this->director = $director;
    }

    /**
     * @return mixed
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * @param mixed $producer
     */
    public function setProducer($producer): void
    {
        $this->producer = $producer;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->release_date;
    }

    /**
     * @param mixed $release_date
     */
    public function setReleaseDate($release_date): void
    {
        $this->release_date = $release_date;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
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
