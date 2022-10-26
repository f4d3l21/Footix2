<?php

namespace App\Controller;

use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class TeamController extends AbstractController
{
    #[Route('/team', name: 'app_team')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TeamController.php',
        ]);
    }

    #[Route('/api/teams', name: 'teams.getAll', methods: ['GET'])]
    public function getTeams(
        TeamRepository $repository,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
    ): JsonResponse {
        $teams = $repository->findAll();
        $data = $serializer->serialize($teams, 'json', [
            'groups' => ['team']
        ]);
        $errors = $validator->validate($teams);
        if ($errors->count() > 0) {
            $errorsJson = $serializer->serialize($errors, 'json');
            return new JsonResponse($errorsJson, Response::HTTP_BAD_REQUEST, [], true);
        }
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }


    #[Route('/api/teams/{id}', name: 'teams.getOne', methods: ['GET'])]
    // #[IsGranted('ROLE_ADMIN', message: 'Tu es rentré dans le panneau')]
    public function getOneTeam(
        TeamRepository $repository,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        int $id
    ): JsonResponse {
        $team = $repository->find($id);
        $team->setStatusTeam("on");
        $data = $serializer->serialize($team, 'json', [
            'groups' => ['team']
        ]);
        $errors = $validator->validate($team);
        if ($errors->count() > 0) {
            $errorsJson = $serializer->serialize($errors, 'json');
            return new JsonResponse($errorsJson, Response::HTTP_BAD_REQUEST, [], true);
        }
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * Route to create a new team
     *
     * @param ValidatorInterface $validator
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */

    #[Route('/api/createTeam', name: 'createTeam.create', methods: ['POST'])]
    public function createTeam(ValidatorInterface $validator, Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = $request->getContent();
        $team = $serializer->deserialize($data, Team::class, 'json');
        $team->setStatusTeam("on");
        $errors = $validator->validate($team);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }
        $entityManager->persist($team);
        $entityManager->flush();
        $jsonTeam = $serializer->serialize($team, 'json', ['groups' => 'team']);

        return new JsonResponse($jsonTeam, Response::HTTP_CREATED, [], true);
    }

    //route to update teams
    #[Route('/api/updateTeam/{id}', name: 'updateTeam.update', methods: ['PUT'])]
    public function updateTeam(
        TeamRepository $repository,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager,
        Request $request,
        int $id
    ): JsonResponse {
        $team = $repository->find($id);
        $data = $request->getContent();
        $serializer->deserialize($data, Team::class, 'json', ['object_to_populate' => $team]);
        $errors = $validator->validate($team);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }
        $entityManager->persist($team);
        $entityManager->flush();
        $jsonTeam = $serializer->serialize($team, 'json', ['groups' => 'team']);

        return new JsonResponse($jsonTeam, Response::HTTP_OK, [], true);
    }

    /**
     * Route to delete a team
     * @Route("/api/deleteTeam/{id}", name="deleteTeam.delete", methods={"DELETE"})
     * @param TeamRepository $repository
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param EntityManagerInterface $entityManager
     * @param int $id
     * @return JsonResponse
     */
    
    #[Route('/api/deleteTeam/{idTeam}', name: 'deleteTeam.delete', methods: ['DELETE'])]
    #[ParamConverter('team', options: ['id' => 'idTeam'])]
    public function deleteTeam(
        Team $team,
        EntityManagerInterface $entityManager,
    ): JsonResponse {

        $entityManager->remove($team);
        $entityManager->flush();

        return new JsonResponse("Team deleted", Response::HTTP_OK);
    }

    //route to update status team(soft delete)
    #[Route('/api/softDeleteTeam/{idTeam}', name: 'softDeleteTeam.delete', methods: ['DELETE'])]
    #[ParamConverter('team', options: ['id' => 'idTeam'])]
    public function softDeleteTeam(
        Team $team,
        EntityManagerInterface $entityManager,
    ): JsonResponse {

        $team->setStatusTeam("off");
        $entityManager->flush();

        return new JsonResponse("Status teams turn on off", Response::HTTP_OK);
    }
}
