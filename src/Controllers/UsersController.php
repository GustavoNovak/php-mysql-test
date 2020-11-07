<?php
namespace CarSharing\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Http\Request;
use Slim\Http\Response;

class UsersController{

    private $em;

    /**
     * UsersController constructor.
     * @param EntityManager $em
     * @param array $settings
     */
    public function __construct(EntityManager $em){
        $this->em = $em;
    }

    /**
     * GET /users
     *
     * @param Request $req
     * @param Response $res
     * @return Response
     * @throws \Exception
     */
    public function getUsers(Request $req, Response $res)
    {
        $body = (object) $req->getParsedBody();

        $pdo = $this->em->getConnection();

        $smtp = $pdo->prepare('SELECT name FROM users');
        $smtp->execute();
        $users = $smtp->fetchAll();

        $response = [];
        if($users !== false){
            foreach ($users as $user) {
                $response[] = [
                    'id' => $user['id'], 
                    'name' => $user['name']
                ];
            }
        }

        return $res->withJson($response)->withStatus(200);
    }


    /**
     * GET /user/{id}
     *
     * @param Request $req
     * @param Response $res
     * @return Response
     * @throws \Exception
     */
    public function getUser(Request $req, Response $res)
    {
        $id_user = $req->getAttribute('id');

        $pdo = $this->em->getConnection();

        $smtp = $pdo->prepare('SELECT * FROM users WHERE id = :user');
        $smtp->execute([':user' => $id_user]);
        $user = $smtp->fetc();

        return $res->withJson([
            'id'   => $user['id'], 
            'name' => $user['nome']
        ])->withStatus(200);
    }

}