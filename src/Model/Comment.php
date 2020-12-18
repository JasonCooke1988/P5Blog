<?php


namespace App\Model;


class Comment extends Entity
{
    /**
     * @var string
     */
    private string $content;


    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $this->cleanData($content);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }




}