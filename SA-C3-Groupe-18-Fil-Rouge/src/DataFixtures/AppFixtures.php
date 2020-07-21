<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use App\Entity\User;
use App\Repository\ProfilRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $tabRoles = ['ROLE_ADMIN','ROLE_APPRENANT','ROLE_FORMATEUR', 'ROLE_CM'];
        $tab = ['admin', "apprenant","formateur", "cm"];

        $tabUser = [
            [
                "prenom"=>'admin',
                'nom'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>'admin'
            ],
            [
                "prenom"=>'apprenant',
                'nom'=>'apprenant',
                'email'=>'apprenant@gmail.com',
                'password'=>'apprenant'
            ],
            [
                "prenom"=>'formateur',
                'nom'=>'formateur',
                'email'=>'formateur@gmail.com',
                'password'=>'formateur'
            ],
            [
                "prenom"=>'cm',
                'nom'=>'cm',
                'email'=>'cm@gmail.com',
                'password'=>'cm'
            ],
        ];
        for ($i=0;$i<count($tab);$i++){
            $profils = new Profil();
            $profils->setLibell($tab[$i]);

            $user = new User();

            $user->setPrenom($tabUser[$i]['prenom']);
            $user->setNom($tabUser[$i]['nom']);
            $user->setEmail($tabUser[$i]['email']);
            $password = $this->encoder->encodePassword($user, $tabUser[$i]['password']);
            $user->setPassword($password);
            $user->setProfil($profils);

            $manager->persist($profils);
            $manager->flush();

            $manager->persist($user);
            $manager->flush();

        }







    }
}
