<?php

namespace App\Visit\Infrastructure\Controller;

use App\Auth\Application\AuthService;
use App\Visit\Application\Find\FindAllVisitsByShopService;
use App\Visit\Application\Find\FindAllVisitService;
use App\Visit\Application\Find\FindOneByIdService;
use App\Visit\Domain\Visit;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/visits')]
#[OA\Tag(name: 'Visits')]
#[Security(name: 'ApiKeyAuth')]
class VisitController extends AbstractController
{

    private AuthService $authService;
    private FindAllVisitService $findAllVisitService;
    private FindOneByIdService $findOneByIdService;
    private FindAllVisitsByShopService $findAllVisitsByShopService;

    public function __construct(
        AuthService $authService,
        FindAllVisitService $findAllVisitService,
        FindOneByIdService $findOneByIdService,
        FindAllVisitsByShopService $findAllVisitsByShopService
    )
    {
        $this->authService = $authService;
        $this->findAllVisitService = $findAllVisitService;
        $this->findOneByIdService = $findOneByIdService;
        $this->findAllVisitsByShopService = $findAllVisitsByShopService;
    }

    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Successful response',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Visit::class))
        )
    )]
    public function getVisits(SerializerInterface $serializer, Request $request): JsonResponse
    {
        if(!$auth = ($this->authService)($request->headers->get($this->getParameter('nameToken')))) {
            return new JsonResponse([
                'message' => 'API KEY is not correct'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $result = ($this->findAllVisitService)($auth->getProject());

        $data = $serializer->serialize($result, JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [],true);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Successful response',
        content: new OA\JsonContent(
            ref: new Model(type: Visit::class)
        )
    )]
    #[OA\Parameter(
        name: 'id',
        description: 'Visit ID',
        in: 'path',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    public function getVisitById(SerializerInterface $serializer, Request $request, int $id): JsonResponse
    {
        if(!$auth = ($this->authService)($request->headers->get($this->getParameter('nameToken')))) {
            return new JsonResponse([
                'message' => 'API KEY is not correct'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $result = ($this->findOneByIdService)($auth->getProject(), $id);

        $data = $serializer->serialize($result, JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [],true);
    }

    #[Route('/shop/{shopId}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Successful response',
        content: new OA\JsonContent(
            ref: new Model(type: Visit::class)
        )
    )]
    #[OA\Parameter(
        name: 'shopId',
        description: 'Shop ID',
        in: 'path',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    public function getVisitsByShop(SerializerInterface $serializer, Request $request, int $shopId): JsonResponse
    {
        if(!$auth = ($this->authService)($request->headers->get($this->getParameter('nameToken')))) {
            return new JsonResponse([
                'message' => 'API KEY is not correct'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $result = ($this->findAllVisitsByShopService)($auth->getProject(), $shopId);

        $data = $serializer->serialize($result, JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [],true);
    }
}
