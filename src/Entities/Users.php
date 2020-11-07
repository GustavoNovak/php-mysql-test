<?php

namespace CarSharing\Entities;

use Doctrine\DBAL\Driver\PDOConnection;
use Doctrine\ORM\EntityRepository;

class UsersRepositories extends EntityRepository 
{

    /**
     * @param $settings
     * @param array $form
     * @return array
     * @throws \Exception
     */
    public function getUser(int $idUser){
        $pdo = $this->getEntityManager()->getConnection();

        $smtp = $pdo->prepare('SELECT * FROM users WHERE id = :yser');
        $smtp->execute([':user' => $id_user]);
        $user = $smtp->fetch();

        return $user; 
    }

}