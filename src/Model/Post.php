<?php

namespace App\Model;


class Post extends Entity

{

    /**
     * @var string
     */
    private string $title;
    /**
     * @var string
     */
    private string $content;
    /**
     * @var string
     */
    private string $header;
    /**
     * @var array
     */
    private array $comments;

    /**
     * @var string
     */
    private string $firstName;

    /**
     * @var string
     */
    private string $lastName;


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }


    /**
     * @return string
     */
    public function getHeader(): string
    {
        return $this->header;
    }


    /**
     * @param array $comments
     */
    public function setComments(array $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}