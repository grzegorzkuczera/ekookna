<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private const USERS = [
        [
            'username' => 'grzegorz',
            'email' => 'grzegorzkuczera@gmail.com',
            'password' => 'grzegorz123',       
            'roles' => [User::ROLE_ADMIN]
        ]     
    ];

    /**
     * @var UserPasswordEncoderInterface
     */

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $this->loadUsers($manager);
        //$manager->flush();
    }

    private function loadUsers(ObjectManager $manager)
    {
        foreach (self::USERS as $userData) {
            $user = new User();
            $user->setUsername($userData['username']);
            $user->setEmail($userData['email']);
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $userData['password']
                )
            );
            $user->setRoles($userData['roles']);
           
            $manager->persist($user);
        }

        $manager->flush();
    }
}
