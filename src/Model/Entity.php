<?php


namespace App\Model;


abstract class Entity
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $createdAt;

    /**
     * @var mixed
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected string $firstName;

    /**
     * @var string
     */
    protected string $lastName;

    public function __set($name, $value)
    {
        $this->$name = $this->cleanData($value);
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return empty($this->entityid);
    }

    /**
     * @return int
     */
    public function getid(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        setlocale(LC_TIME, "fr_FR", 'French');
        return utf8_encode(ucfirst(strftime("%A %d %B %G", strtotime($this->createdAt))));
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $this->cleanData($id);
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $this->cleanData($createdAt);
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt(mixed $updatedAt): void
    {
        $this->updatedAt = $this->cleanData($updatedAt);
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $this->cleanData($firstName);
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $this->cleanData($lastName);
    }

    /**
     * @param string $string
     * @return string
     */
    public function cleanData(string $string): string
    {
        return stripslashes(htmlspecialchars($string));
    }

    /**
     * @return array
     */
    public function iterate()
    {
        $array = [];
        foreach ($this as $key => $value) {
            $array[$key] = $value;
        }
        return $array;
    }

}