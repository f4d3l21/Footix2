<?php

namespace App\Controller;

use App\Entity\Picture;
use OpenApi\Annotations as OA;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @OA\Tag(name="Picture")
     */
    #[Route('/api/picture/{idPicture}', name: 'picture.get', methods: ['GET'])]
    #[ParamConverter('picture', options: ['id' => 'idPicture'])]
    public function getPicture(
        int $idPicture,
        SerializerInterface $serializer,
        PictureRepository $pictureRepository,
        Request $request,
        TagAwareCacheInterface $cache
    ): JsonResponse {
        $picture = $pictureRepository->find($idPicture);
        $idCache = 'getPicture' . $picture->getId();
        $relativePath = $picture->getPublicPath() . "/" . $picture->getRealPath();
        $location = $request->getUriForPath('/');
        $location = $location . str_replace("/assets", "assets", $relativePath);
        if ($picture !== null) {
            $data = $cache->get($idCache, function (ItemInterface $item) use ($picture, $serializer) {
                echo 'Mise en cache OK';
                $item->tag('pictureCache');
                $context = array(SerializationContext::create()->setGroups(['getPicture']));
                return $serializer->serialize($picture, 'json', $context);
            });
            return new JsonResponse($data, Response::HTTP_OK, ["Location" => $location], true);
        }
        return new JsonResponse(null, JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * Route for create a picture
     * @OA\Tag(name="Picture")
     * Security(name: 'Bearer')]
     *@OA\RequestBody(
     *      description= "Complete field to create a picture",
     *      required= true,
     *      @OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="realName", type="string"),
     *          @OA\Property(property="realPath", type="string"),
     *          @OA\Property(property="mimeType", type="image/png"),
     *      )
     * )
     */
    #[Route('/api/pictures', name: 'picture.create', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN', message: 'Vous n\'avez pas les droits pour accéder à cette ressource.')]
    public function createPicture(
        Request $request,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        UrlGeneratorInterface $urlGenerator,
        TagAwareCacheInterface $cache
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

        $cache->invalidateTags(['pictureCache']);

        $location = $urlGenerator->generate('picture.get', ['idPicture' => $picture->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        $jsonPictures = $serializer->serialize($picture, 'json', ['groups' => 'getPicture']);
        return new JsonResponse($jsonPictures, Response::HTTP_OK, ['Location' => $location], true);
    }

    /**
     * Route for update a picture
     * @OA\Tag(name="Picture")
     * Security(name: 'Bearer')]
     */
    #[Route('/api/deletePicture/{idPicture}', name: 'picture.delete', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN', message: 'Vous n\'avez pas les droits pour accéder à cette ressource.')]
    #[ParamConverter('picture', options: ['id' => 'idPicture'])]
    public function softDeletePicture(
        int $idPicture,
        EntityManagerInterface $entityManager,
        PictureRepository $pictureRepository,
        TagAwareCacheInterface $cache
    ): JsonResponse {

        $cache->invalidateTags(['pictureCache']);

        if ($picture = $pictureRepository->find($idPicture)) {
            $picture->setStatus("off");
            $entityManager->persist($picture);
            $entityManager->flush();
            return new JsonResponse("Picture deleted with status on off", JsonResponse::HTTP_OK, [], true);
        } else {
            return new JsonResponse("Status change not changed", JsonResponse::HTTP_NOT_FOUND, [], true);
        }
    }
}
