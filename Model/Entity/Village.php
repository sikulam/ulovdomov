<?php
declare(strict_types=1);

namespace App\Model\Entity;

class Village
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Village
     */
    public function setId(int $id): Village
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Village
     */
    public function setName(string $name): Village
    {
        $this->name = $name;

        return $this;
    }
}