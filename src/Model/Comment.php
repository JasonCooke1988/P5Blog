<?php


namespace App\Model;


class Comment extends Entity
{
    /**
     * @var string
     */
    private string $post;

    /**
     * @var string
     */
    private string $content;

    /**
     * @var string
     */
    private string $firstName;

    /**
     * @var string
     */
    private string $lastName;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPost(): string
    {
        return $this->post;
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
    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

}