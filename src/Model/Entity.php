<?php


namespace App\Model;


abstract class Entity
{
    protected int $id;
    protected string $createdAt;
    protected $updatedAt;

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return empty($this->id);
    }

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
    public function getCreatedAt(): string
    {
        setlocale(LC_TIME, "fr_FR",'French');
        return ucfirst(strftime("%A %d %B %G", strtotime($this->createdAt)));
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     * @return void
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

}