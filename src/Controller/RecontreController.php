<?php

namespace App\Controller;

use App\Repository\TeamRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecontreController extends AbstractController
{
    #[Route('/rencontre', name: 'app_recontre')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RecontreController.php',
        ]);
    }

    #[Route('/api/rencontre', name: 'rencontre.getAll', methods: ['GET'])]
    public function getRencontre(
        TeamRepository $repository,
        SerializerInterface $serializer
    ): JsonResponse {
        $rencontre = $repository->findAll();
        $data = $serializer->serialize($rencontre, 'json', [
            'groups' => ['rencontre']
        ]);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    #[Route('/api/rencontre/{id}', name: 'rencontre.getOne', methods: ['GET'])]
    public function getOneRencontre(
        TeamRepository $repository,
        SerializerInterface $serializer,
        int $id
    ): JsonResponse {
        $oneRencontre = $repository->find($id);
        $data = $serializer->serialize($oneRencontre, 'json', [
            'groups' => ['rencontre']
        ]);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
