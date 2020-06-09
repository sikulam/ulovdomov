<?php
declare(strict_types=1);

namespace App\Model;

use App\Model\Entity\UserAdmin;

class UserAdminModel
{
    /** @var array */
    private $villages;

    public function __construct(VillageModel $villages)
    {
        $this->villages = $villages->getVillages();
    }

    public function getUsers(): array
    {
        return [
            1 => [
                'name'   => 'Adam',
                'rights' => [
                    'addressBook' => [
                        1 => true,
                        2 => false,
                    ],
                    'search'      => [
                        1 => true,
                        2 => false,
                    ],
                ],
            ],
            2 => [
                'name'   => 'Bob',
                'rights' => [
                    'addressBook' => [
                        1 => false,
                        2 => true,
                    ],
                    'search'      => [
                        1 => true,
                        2 => false,
                    ],
                ],
            ],
            3 => [
                'name'   => 'Cyril',
                'rights' => [
                    'addressBook' => [
                        1 => true,
                        2 => true,
                    ],
                    'search'      => [
                        1 => false,
                        2 => true,
                    ],
                ],
            ],
            4 => [
                'name'   => 'Fred',
                'rights' => [
                    'addressBook' => [
                        1 => true,
                        2 => true,
                    ],
                    'search'      => [
                        1 => true,
                        2 => true,
                    ],
                ],
            ],
        ];
    }

    public function set(UserAdmin $user, array $rights): void
    {
        $rightsModel = new UserAdminRightsModel();
        $villageModel = new VillageModel();
        $villagesById = $villageModel->getVillagesEntities();

        foreach ($rights as $rightType => $villageRights) {
            $checked = false;
            foreach ($villageRights as $villageId => $value) {
                if ($value === true) {
                    $checked = true;
                    continue;
                }
            }

            if ($checked === true) {
                foreach ($villageRights as $villageId => $value) {
                    $rightsModel->addRights($user, $villagesById[$villageId], $rightType, $value);
                }
            } else {
                foreach ($villagesById as $village) {
                    $rightsModel->addRights($user, $village, $rightType, true);
                }
            }
        }
    }

    public function get(UserAdmin $user, string $rightsType): array
    {
        $rightsModel = new UserAdminRightsModel();

        // getUserRightsByTypeForVillages - model by vrátil dle dotazu do datábaze seznam měst kde má uživatel pro dané právo true
        return $rightsModel->getUserRightsByTypeForVillages($user, $rightsType);
    }

    public function addUserAdmin(string $name): void
    {
        $user = new UserAdmin();
        $user->setName($name);
        $user->setRights($this->getAllRights());

        // ulozeni entity do DB
    }

    public function setRightsForNewVillage(Village $village): void
    {
        $rightsModel = new UserAdminRightsModel();
        $users = $this->getUsers();
        /** @var UserAdmin $user */
        foreach ($users as $user) {
            // addRights - metoda na uložení oprávnění pro daného uživatele
            // vycházelo by to z tabulky/entity UserAdminRights
            $rightsModel->addRights($user, $village, 'addressBook', $this->checkRights($user, 'addressBook'));
            $rightsModel->addRights($user, $village, 'search', $this->checkRights($user, 'search'));
        }
    }

    private function getAllRights(): array
    {
        $rights = [];
        foreach ($this->villages as $key => $village) {
            $rights['addressBook'][$key] = true;
            $rights['search'][$key] = true;
        }

        return $rights;
    }

    private function checkRights(UserAdmin $user, string $type): bool
    {
        $rightsModel = new UserAdminRightsModel();
        // checkRightsByType - metoda by vrátila bool - pokud by měl uživatel pro všechna města oprávnění tak true jinak false
        // vycházelo by to z tabulky/entity UserAdminRights
        // v modelu by pak byl sql dotaz na oprávnění zda má pro všechna města true
        $rights = $rightsModel->checkRightsByType($user, $type);

        return $rights;
    }
}