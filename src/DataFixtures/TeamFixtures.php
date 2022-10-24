<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Team;
use App\Entity\Rencontre;
use DateTime;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $teamList = [];


        for ($i=0; $i < 10 ; $i++) { 
            //Generer des teams
            $team = new Team();
            $team->setTeamName("Team $i");
            
            $team->setStatusTeam("on");
            $teamList[] = $team;
            $manager->persist($team);

        }

        for ($i=0; $i < 20; $i++) { 
            $rencontre = new Rencontre();
            $teamUn = rand(0,9);
            $teamDeux = rand(0,9);
            $rencontre->setTeamA($teamList[$teamUn]);
            while($teamDeux === $teamUn){
                $teamDeux = rand(0,9);
            }

            $rencontre->setTeamB( $teamList[$teamDeux]);
            $scoreUn = rand(0,10);
            $scoreDeux = rand(0,10);
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
