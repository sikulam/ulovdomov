<?php
declare(strict_types=1);

namespace App\Model\Entity;

class UserAdminRights
{
    /**
     * Tabulka user_admin_rights
     * -----------------------------------------------------------------
     * | id - autoincrement int(11) unsigned
     * | type_id - cizý klíč na tabulku s názvem oprávnění aktuálně hodnot addressbook a search
     * | village_id - cizý klíč na tabulku village
     * | user_admin_id - cizý klíč na tabulku user_admin
     */



    /**
     * @var int
     */
    protected $id;

    /**
     * predpokladam napojeni na tabulku s typem opravneni aktuálně by nabývalo hodnot
     * @var string
     */
    protected $type;

    /**
     * @var UserAdmin
     */
    protected $userAdmin;

    /**
     * @var Village
     */
    protected $village;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserAdminRights
     */
    public function setId(int $id): UserAdminRights
    {
        $this->id = $id;

        return $this;
    }
}