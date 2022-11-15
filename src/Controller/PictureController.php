<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use OpenApi\Attributes as OA;

class PictureController extends AbstractController
{
    #[Route('/picture', name: 'app_picture')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PictureController.php',
        ]);
    }

    /**
     * Route to get one picture by id
     */
    #[OA\Tag(name: 'Picture')]
    #[Route('/api/picture/{idPicture}', name: 'picture.get', methods: ['GET'])]
    public function getPicture(
        int $idPicture,
        SerializerInterface $serializer,
        PictureRepository $pictureRepository,
        Request $request,
    ): JsonResponse {
        $picture = $pictureRepository->find($idPicture);

        $relativePath = $picture->getPublicPath() . "/" . $picture->getRealPath();
        $location = $request->getUriForPath('/');
        $location = $location . str_replace("/assets", "assets", $relativePath);
        if ($picture) {
            return new JsonResponse( $serializer->serialize($picture,'json',["groups" => "getPicture"]),JsonResponse::HTTP_OK,["Location" => $location],true);
        } else {
            return new JsonResponse(null, JsonResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Routes for create and insert a picture
     */
    #[OA\Tag(name: 'Picture')]
    // #[OA\Parameter(
    //     name: 'order',
    //     in: 'query',
    //     description: 'The field used to order rewards',
    //     schema: new OA\Schema(type: 'string')
    // )]
    #[Route('/api/pictures', name: 'picture.create', methods: ['POST'])]
    public function createPicture(
        Request $request, 
        EntityManagerInterface $entityManager, 
        SerializerInterface $serializer, 
        UrlGeneratorInterface $urlGenerator
        ): JsonResponse {
        $picture = new Picture();
        $files = $request->files->get('file');
        $picture->setFile($files);
        $picture->setMimeType($files->getClientMimeType());
        $picture->setRealName($files->getClientOriginalName());
        $picture->setPublicPath("/assets/pictures");
        $picture->setStatus("on");
        $entityManager->persist($picture);
        $entityManager->flush();

        $location = $urlGenerator->generate('picture.get', ['idPicture' => $picture->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        $jsonPictures = $serializer->serialize($picture, 'json', ['groups' => 'getPicture']);
        return new JsonResponse($jsonPictures, Response::HTTP_OK, ['Location' => $location], true);
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PictureController.php',
        ]);
    }
}
