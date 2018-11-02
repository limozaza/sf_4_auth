<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
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
        for ($i=0;$i<10;$i++){
            $user = new User();
            $user->setEmail(sprintf('zak_%d@yopmail.com',$i));
            $user->setFirstName(sprintf('zakaria_%d',$i));
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,'dole'
                )
            );

            $manager->persist($user);
        }


        for ($i=0;$i<2;$i++){
            $user = new User();
            $user->setEmail(sprintf('zak_admin%d@yopmail.com',$i));
            $user->setFirstName(sprintf('zakaria_admin%d',$i));
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,'dole'
                )
            );

            $manager->persist($user);
        }


        $manager->flush();
    }
}
