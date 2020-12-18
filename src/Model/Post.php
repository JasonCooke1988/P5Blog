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
     * @param array $comments
     */
    public function setComments(array $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $this->cleanData($title);
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $this->cleanData($content);
    }

    /**
     * @param string $header
     */
    public function setHeader(string $header): void
    {
        $this->header = $this->cleanData($header);
    }


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
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

}