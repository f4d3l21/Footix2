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

class PictureController extends AbstractController
{
    /**
     * Route Main page
     * @return JsonResponse
     */
    #[Route('/picture', name: 'app_picture')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PictureController.php',
        ]);
    }

    /**
     * Route for get one picture
     * @Route("/api/pictures", name="pictures.get", methods={"GET"})
     * @param int $idPicture
     * @param SerializerInterface $serializer
     * @param PictureRepository $repository
     * @param Request $request
     * @return JsonResponse
     */
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
            return new JsonResponse(
                $serializer->serialize(
                    $picture,
                    'json',
                    ["groups" => "getPicture"]
                ),
                JsonResponse::HTTP_OK,
                ["Location" => $location],
                true
            );
        } else {
            return new JsonResponse(null, JsonResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Route for insert a picture 
     * @Route("/api/pictures", name="pictures.create", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $serializer
     * @param UrlGeneratorInterface $urlGenerator
     * @return JsonResponse
     */
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
