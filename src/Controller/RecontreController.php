<?php

namespace App\Controller;

use App\Entity\Rencontre;
use App\Entity\Team;
use JMS\Serializer\Serializer;
use App\Repository\TeamRepository;
use App\Repository\RencontreRepository;
use Doctrine\Persistence\ObjectManager;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializationContext;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use OpenApi\Attributes as OA;

class RecontreController extends AbstractController
{

    #[OA\Tag(name: 'Rencontre')]
    #[Route('/rencontre', name: 'app_recontre')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RecontreController.php',
        ]);
    }

    /**
     * Route to get all rencontres
     */
    #[OA\Tag(name: 'Rencontre')]
    #[Route('/api/rencontres', name: 'rencontres.getAll', methods: ['GET'])]
    public function getRencontres(
        RencontreRepository $repository,
        SerializerInterface $serializer,
        TagAwareCacheInterface $cache
    ): JsonResponse {

        $idCache = 'getAllRencontres';
        $data = $cache->get($idCache, function (ItemInterface $item) use ($repository, $serializer) {

            echo 'Mise en cache OK';
            $item->tag('rencontreCache');

            $rencontres = $repository->findAll();
            $context = SerializationContext::create()->setGroups(['rencontre']);
            return $serializer->serialize($rencontres, 'json', $context);
        }); // fin du cache
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }


    /**
     * Route to get one rencontre by id
     */
    #[OA\Tag(name: 'Rencontre')]
    #[Route('/api/rencontres/{id}', name: 'rencontres.getOne', methods: ['GET'])]
    public function getOneRencontre(
        Rencontre $rencontre,
        SerializerInterface $serializer,
        TagAwareCacheInterface $cache
    ): JsonResponse {
        $cacheId = 'getOneRencontre' . $rencontre->getId();
        $data = $cache->get($cacheId, function (ItemInterface $item) use ($rencontre, $serializer) {
            $item->tag('rencontreCache');
            echo 'Mise en cache OK';
            $context = SerializationContext::create()->setGroups(['rencontre']);
            return $serializer->serialize($rencontre, 'json', $context);
        });    
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }


    /**
     * Route to get rencontre team win by id
     */
    #[OA\Tag(name: 'Rencontre')]
    #[Route('/api/rencontres/team/{id}', name: 'rencontres.getByTeam', methods: ['GET'])]
    public function getRencontreByTeam(
        TeamRepository $teamRepository,
        SerializerInterface $serializer,
        TagAwareCacheInterface $cache,
        int $id
    ): JsonResponse {
        $cacheId = 'getRencontreByTeam' . $id;
        $data = $cache->get($cacheId, function (ItemInterface $item) use ($teamRepository, $serializer, $id) {
            $item->tag('rencontreCache');
            echo 'Mise en cache OK';
            $team = $teamRepository->find($id);
            $rencontres = $team->getRencontre();
            $context = SerializationContext::create()->setGroups(['rencontre']);
            return $serializer->serialize($rencontres, 'json', $context);
        });
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * Route to get team ratio by id
     */
    #[OA\Tag(name: 'Rencontre')]
    #[Route('/api/teams/{id}/ratio', name: 'rencontre.getOneRatio', methods: ['GET'])]
    public function getOneTeamRatio(
        RencontreRepository $repository,
        SerializerInterface $serializer,
        TagAwareCacheInterface $cache,
        Team $team,
        ObjectManager $manager,
        int $id
    ): JsonResponse {
        $cacheId = 'getOneTeamRatio' . $id;
        $data = $cache->get($cacheId, function (ItemInterface $item) use ($repository, $serializer, $id, $manager, $team) {
            $item->tag('rencontreCache');
            echo 'Mise en cache OK';
            $AllRencontre = $repository->createQueryBuilder('rencontre')
            ->where('rencontre.teamA = :id')
            ->orWhere('rencontre.teamB = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
                
            $WinnerRencontre = $repository->createQueryBuilder('rencontre')
            ->where('rencontre.winner = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
            $ratio = count($WinnerRencontre) / count($AllRencontre);
            
            // $team = new Team();
            // $team->setRatio($ratio);
            // $manager->persist($team);
            // $manager->flush();
            $context = SerializationContext::create()->setGroups(['rencontre']);
            
            return $serializer->serialize($ratio, 'json', $context);
        });
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    #[OA\Tag(name: 'Team')]
    #[OA\Parameter (name: 'id', in: 'path', description: 'Team poule', required: true)]
    #[Route('/api/teams/poule', name: 'teams.getPoule', methods: ['GET'])]
    public function getPouleTeam(
        TeamRepository $repository,
        SerializerInterface $serializer,
        TagAwareCacheInterface $cache, 
        ): JsonResponse {
            $idCache = 'getAllTeamsPoule';
            $data = $cache->get($idCache, function (ItemInterface $item) use ($repository, $serializer) {
            
            echo 'Mise en cache OK';
            $item->tag('pouleCache');

            // $poule = $repository->findAll(rand());

            $AllRencontre = $repository->createQueryBuilder('team')
            ->orderBy('poule')
            ->where('poule = :id')
            ->getQuery()
            ->getResult();

            $context = SerializationContext::create()->setGroups(['team']);
            return $serializer->serialize($AllRencontre, 'json', $context);
        });
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

}
