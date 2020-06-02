<?php
declare(strict_types=1);

namespace App\Model\Entity;

class UserAdmin
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
     * @var array
     */
    protected $rights;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserAdmin
     */
    public function setId(int $id): UserAdmin
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
     * @return UserAdmin
     */
    public function setName(string $name): UserAdmin
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getRights(): string
    {
        return json_decode($this->rights, true);
    }

    /**
     * @param array $rights
     * @return UserAdmin
     */
    public function setRights(array $rights): UserAdmin
    {
        $this->rights = json_encode($rights);

        return $this;
    }
}