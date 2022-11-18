<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Team;
use App\Entity\User;
use App\Entity\Rencontre;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TeamFixtures extends Fixture
{
    /**
     * Class Hasheant the password
     *
     * @var UserPasswordHasherInterface
     */
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->faker = \Faker\Factory::create('fr_FR');
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $userNumber = 10;

        //Authenticated admin
        $adminUser = new User();
        $password = "password";
        $adminUser->setUsername("admin")
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword($this->userPasswordHasher->hashPassword($adminUser, $password));
        $manager->persist($adminUser);

        //Authenticated users
        for ($i = 0; $i < $userNumber; $i++) {
            $userUser = new User();
            $password = $this->faker->password(2, 6);
            $userUser->setUsername($this->faker->userName() . '@' . $password)
                ->setRoles(["ROLE_USER"])
                ->setPassword($this->userPasswordHasher->hashPassword($userUser, $password));
            $manager->persist($userUser);
        }
        $teamList = [];

        for ($i = 0; $i < 10; $i++) {
            $team = new Team();
            $team->setTeamName("Team $i");
            $team->setStatusTeam("on");
            $team->setPoule(rand(1, 2));
            $teamList[] = $team;
            $manager->persist($team);
        }

        for ($i = 0; $i < 20; $i++) {
            $rencontre = new Rencontre();
            $teamUn = rand(0, 9);
            $teamDeux = rand(0, 9);
            $rencontre->setTeamA($teamList[$teamUn]);
            while ($teamDeux === $teamUn) {
                $teamDeux = rand(0, 9);
            }

            $rencontre->setTeamB($teamList[$teamDeux]);
            $scoreUn = rand(0, 10);
            $scoreDeux = rand(0, 10);
            $rencontre->setScoreA($scoreUn);
            $rencontre->setScoreB($scoreDeux);
            $rencontre->setWinner($scoreUn > $scoreDeux ? $teamList[$teamUn] : $teamList[$teamDeux]);
            $rencontre->setDate(new DateTime());
            $rencontre->setStatus('on');
            $manager->persist($rencontre);
        }
        $manager->flush();
    }
}
