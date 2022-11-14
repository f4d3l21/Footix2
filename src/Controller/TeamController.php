<?php

namespace App\Controller;

use App\Entity\Team;
use App\Repository\TeamRepository;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializationContext;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class TeamController extends AbstractController
{
    /**
     * Route Main page
     * @return JsonResponse
     */
    #[Route('/team', name: 'app_team')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TeamController.php',
        ]);
    }

    /**
     * Route for get all teams
     * @Route("/api/teams", name="teams.getAll", methods={"GET"})
     * @param TeamRepository $repository
     * @param SerializerInterface $serializer
     * @param TagAwareCacheInterface $cache
     * @return JsonResponse
     */
    #[Route('/api/teams', name: 'teams.getAll', methods: ['GET'])]
    public function getTeams(
        TeamRepository $repository,
        SerializerInterface $serializer,
        TagAwareCacheInterface $cache
    ): JsonResponse {

        $idCache = 'getAllTeams';
        $data = $cache->get($idCache, function (ItemInterface $item) use ($repository, $serializer) {

            echo 'Mise en cache OK';
            $item->tag('teamCache');

            $teams = $repository->findAll();
            $context = SerializationContext::create()->setGroups(['team']);
            return $serializer->serialize($teams, 'json', $context);
        });
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * Route for get one team by id
     * @Route("/api/teams/{id}", name="teams.getOne", methods={"GET"})
     * @param TeamRepository $repository
     * @param SerializerInterface $serializer
     * @param TagAwareCacheInterface $cache
     * @param int $id
     * @return JsonResponse
     */
    #[Route('/api/teams/{id}', name: 'teams.getOne', methods: ['GET'])]
    // #[IsGranted('ROLE_ADMIN', message: 'Tu es rentré dans le panneau')]
    public function getOneTeam(
        TeamRepository $repository,
        SerializerInterface $serializer,
        TagAwareCacheInterface $cache,
        int $id
    ): JsonResponse {
        $idCache = 'getOneTeam';
        $data = $cache->get($idCache, function (ItemInterface $item) use ($repository, $serializer, $id) {
            echo 'Mise en cache OK';
            $item->tag('teamCache');

            $team = $repository->find($id);
            $team->setStatusTeam("on");
            $context = SerializationContext::create()->setGroups(['team']);
            return $serializer->serialize($team, 'json', $context);
        });
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * Route to create a new team
     * @Route("/api/createTeam", name="createTeam.create", methods={"POST"})
     * @param ValidatorInterface $validator
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */

    #[Route('/api/createTeam', name: 'createTeam.create', methods: ['POST'])]
    public function createTeam(
        ValidatorInterface $validator, 
        Request $request, 
        SerializerInterface $serializer, 
        EntityManagerInterface $entityManager
        ): JsonResponse {
        $data = $request->getContent();
        $team = $serializer->deserialize($data, Team::class, 'json');
        $team->setStatusTeam("on");
        $errors = $validator->validate($team);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }
        $entityManager->persist($team);
        $entityManager->flush();
        $context = SerializationContext::create()->setGroups(['team']);
        $jsonTeam = $serializer->serialize($team, 'json', $context);

        return new JsonResponse($jsonTeam, Response::HTTP_CREATED, [], true);
    }

    /**
     * Route to update a team
     * @Route("/api/updateTeam/{id}", name="updateTeam.update", methods={"PUT"})
     * @param TeamRepository $repository
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @param TagAwareCacheInterface $cache
     * @param int $id
     * @return JsonResponse
     */
    #[Route('/api/updateTeam/{id}', name: 'updateTeam.update', methods: ['PUT'])]
    public function updateTeam(
        TeamRepository $repository,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        Request $request,
        TagAwareCacheInterface $cache,
        int $id
    ): JsonResponse {

        $cache->invalidateTags(['teamCache']);
        $team = $repository->find($id);
        $data = $request->getContent();

        $updateTeam = $serializer->deserialize($data, Team::class, 'json');
        $team->setTeamName($updateTeam->getTeamName() ? $updateTeam->getTeamName() : $team->getTeamName());
        $team->setStatusTeam($updateTeam->getStatusTeam() ? $updateTeam->getStatusTeam() : $team->getStatusTeam());
        $entityManager->persist($team);
        $entityManager->flush();
        $context = SerializationContext::create()->setGroups(['team']);
        $jsonTeam = $serializer->serialize($team, 'json', $context);

        return new JsonResponse($jsonTeam, Response::HTTP_OK, [], true);
    }

    /**
     * Route to delete a team with it's id
     * @Route("/api/deleteTeam/{idTeam}", name="deleteTeam.delete", methods={"DELETE"})
     * @param Team $team
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    #[Route('/api/deleteTeam/{idTeam}', name: 'deleteTeam.delete', methods: ['DELETE'])]
    #[ParamConverter('team', options: ['id' => 'idTeam'])]
    public function deleteTeam(
        Team $team,
        EntityManagerInterface $entityManager,
    ): JsonResponse {
        $rencontres = $team->getRencontre();
        foreach ($rencontres as $rencontre) {

            $entityManager->remove($rencontre);
        }

        $entityManager->remove($team);
        $entityManager->flush();
        return new JsonResponse("Team deleted", Response::HTTP_OK, [], true);
    }

    /**
     * Route to update status team. Method SoftDelete
     * @Route("/api/softDeleteTeam/{idTeam}", name="softDeleteTeam.delete", methods={"DELETE"})
     * @param Team $team
     * @param EntityManagerInterface $entityManager,
     * @return JsonResponse
     */
    #[Route('/api/softDeleteTeam/{idTeam}', name: 'softDeleteTeam.delete', methods: ['DELETE'])]
    #[ParamConverter('team', options: ['id' => 'idTeam'])]
    public function softDeleteOneTeam(
        Team $team,
        EntityManagerInterface $entityManager,
    ): JsonResponse {

        $team->setStatusTeam("off");
        $entityManager->flush();

        return new JsonResponse("Status team turn on off", Response::HTTP_OK);
    }
}
