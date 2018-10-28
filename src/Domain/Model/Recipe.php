<?php

namespace App\Domain\Model;


/**
 * Class Recipe
 */
class Recipe
{
    /** @var string */
    protected $title;
    /** @var string */
    protected $href;
    /** @var array */
    protected $ingredients;
    /** @var string */
    protected $thumbnail;

    /**
     * Recipe constructor.
     */
    public function __construct()
    {
        $this->title = '';
        $this->href = '';
        $this->ingredients = [];
        $this->thumbnail = '';
    }

    /**
     * Gets recipe title.
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets recipe title.
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets recipe href
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * Sets recipe href
     * @param string $href
     *
     * @return self
     */
    public function setHref(string $href): self
    {
        $this->href = $href;

        return $this;
    }

    /**
     * Gets recipe ingredients.
     * @return array
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    /**
     * Sets recipe ingredients.
     * @param string $ingredients
     *
     * @return self
     */
    public function setIngredients(string $ingredients): self
    {
        $this->ingredients = explode(', ', $ingredients);

        return $this;
    }

    /**
     * Gets recipe thumbnail
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * Sets recipe thumbnail
     * @param string $thumbnail
     *
     * @return self
     */
    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return array
     */
    public function __toJson(): array
    {
        return get_object_vars($this);
    }

}
