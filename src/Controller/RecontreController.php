<?php

namespace App\Controller;

use App\Entity\Rencontre;
use App\Repository\TeamRepository;
use App\Repository\RencontreRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecontreController extends AbstractController
{

    /**
     * Route Main page
     * @Route("/api/rencontres", name="rencontres.getAll", methods={"GET"})
     */
    #[Route('/rencontre', name: 'app_recontre')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RecontreController.php',
        ]);
    }

    /**
     * Route for get all rencontres between two teams
     * @Route("/api/rencontres", name="rencontres.getAll", methods={"GET"})
     * @param RencontreRepository $repository
     * @param SerializerInterface $serializer
     * @param TagAwareCacheInterface $cache
     * @return JsonResponse
     */
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
     * Route for get one rencontre between two teams by id
     * @Route("/api/rencontres/{id}", name="rencontres.getOne", methods={"GET"})
     * @param Rencontre $rencontre
     * @param SerializerInterface $serializer
     * @param int $id
     * @return JsonResponse
     */
    #[Route('/api/rencontres/{id}', name: 'rencontres.getOne', methods: ['GET'])]
    public function getOneRencontre(
        Rencontre $rencontre,
        SerializerInterface $serializer
    ): JsonResponse {
        $data = $serializer->serialize($rencontre, 'json', [
            'groups' => ['rencontre']
        ]);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * Route for get wins of team by id
     * @Route("/api/rencontres/team/{id}", name="rencontres.getByTeam", methods={"GET"})
     * @param TeamRepository $teamRepository
     * @param SerializerInterface $serializer
     * @param int $id
     * @return JsonResponse
     */
    #[Route('/api/rencontres/team/{id}', name: 'rencontres.getByTeam', methods: ['GET'])]
    public function getRencontreByTeam(
        TeamRepository $teamRepository,
        SerializerInterface $serializer,
        int $id
    ): JsonResponse {
        $team = $teamRepository->find($id);
        $rencontres = $team->getRencontreWin();
        $data = $serializer->serialize($rencontres, 'json', [
            'groups' => ['rencontre']
        ]);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * Route for get ratio of team 
     * @Route("//api/teams/{id}/ratio", name="rencontre.getOneRatio", methods={"POST"})
     * @param RencontreRepository $rencontreRepository
     * @param SerializerInterface $serializer
     * @param int $id
     * @return JsonResponse
     */
    #[Route('/api/teams/{id}/ratio', name: 'rencontre.getOneRatio', methods: ['GET'])]
    public function getOneTeamRatio(
        RencontreRepository $repository,
        SerializerInterface $serializer,
        int $id
    ): JsonResponse {
        $AllRencontre = $repository->createQueryBuilder('rencontre')
            ->where('rencontre.teamA = :id')
            ->orWhere('rencontre.teamB = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();

        $WinnerRencontre = $repository->createQueryBuilder('rencontre')
            ->where('rencontre.winner = :id')
            // ->orWhere('rencontre.teamB = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        $ratio = count($WinnerRencontre) / count($AllRencontre);
        $data = $serializer->serialize($ratio, 'json', [
            'groups' => 'rencontre'
        ]);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
