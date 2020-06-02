<?php
declare(strict_types=1);

namespace App\Model;

use App\Model\Entity\Village;

class VillageModel
{
    public function getVillages(): array
    {
        return [
            '1' => 'Praha',
            '2' => 'Brno',
        ];
    }

    public function addVillage(string $name): void
    {
        $village = new Village();
        $village->setName($name);
        // $village = $entityManager->save($village) ulozeni do DB

        $userAdminModel = new UserAdminModel($this);
        $userAdminModel->setRightsForNewVillage($village);
    }

    public function getVillagesEntities(): array
    {
        // z DB načtené pole entit indexované dle ID

        return [];
    }
}