<?php


namespace Data;


class IndexViewData
{
    /**
     * @var \Generator|Genre[]
     */
    private $genres;

    private $errors = null;

    private $formData = [];

    /**
     * @return Genre[]|\Generator
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @return null
     */
    public function getError()
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getFormData()
    {
        return $this->formData;
    }

    /**
     * @param callable $genres
     */
    public function setGenres(callable $genres)
    {
        $this->genres = $genres();
    }

    /**
     * @param null $errors
     */
    public function setError($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @param array $formData
     */
    public function setFormData(array $formData)
    {
        $this->formData = $formData;
    }



}