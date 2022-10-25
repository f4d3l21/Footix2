<?php

namespace App\Controller;

use App\Repository\TeamRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        ): JsonResponse
    {
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
    public function getOneTeam(
        TeamRepository $repository,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        int $id
        ): JsonResponse
    {
        $team = $repository->find($id);
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



}
