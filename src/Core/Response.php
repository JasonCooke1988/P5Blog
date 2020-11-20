<?php

namespace App\Core;

class Response
{
    /**
     * @var string
     */
    private string $content;
    /**
     * @var int
     */
    private int $status;

    /**
     * Response constructor.
     * @param string $content
     * @param int $status
     */
    public function __construct(string $content, int $status = 200)
    {

        $this->content = $content;
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    public function done()
    {
        if($this->getStatus() === 200) {
            header("HTTP/1.1 200 OK");
        } elseif($this->getStatus() === 404) {
            header("HTTP/1.1 404 Not Found");
        }

        echo $this->content;

    }
}