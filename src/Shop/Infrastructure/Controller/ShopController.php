<?php

namespace App\Shop\Infrastructure\Controller;

use App\Auth\Application\AuthService;
use App\Shop\Application\Find\FindAllShopService;
use App\Shop\Application\Find\FindOneByIdShopService;
use App\Shop\Domain\Shop;
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

#[Route('/shops')]
#[OA\Tag(name: 'Shops')]
#[Security(name: 'ApiKeyAuth')]
class ShopController extends AbstractController
{
    private AuthService $authService;
    private FindAllShopService $findAllShopService;
    private FindOneByIdShopService $findOneByIdShopService;

    public function __construct(
        AuthService $authService,
        FindAllShopService $findAllShopService,
        FindOneByIdShopService $findOneByIdShopService
    )
    {
        $this->authService = $authService;
        $this->findAllShopService = $findAllShopService;
        $this->findOneByIdShopService = $findOneByIdShopService;
    }

    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Successful response',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Shop::class))
        )
    )]
    public function getShops(SerializerInterface $serializer, Request $request): JsonResponse
    {
        if(!$auth = ($this->authService)($request->headers->get($this->getParameter('nameToken')))) {
            return new JsonResponse([
                'message' => 'API KEY is not correct'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $result = ($this->findAllShopService)($auth->getProject());

        $data = $serializer->serialize($result, JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [],true);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Successful response',
        content: new OA\JsonContent(
            ref: new Model(type: Shop::class)
        )
    )]
    #[OA\Parameter(
        name: 'id',
        description: 'Shop ID',
        in: 'path',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    public function getShopById(SerializerInterface $serializer, Request $request, int $id): JsonResponse
    {
        if(!$auth = ($this->authService)($request->headers->get($this->getParameter('nameToken')))) {
            return new JsonResponse([
                'message' => 'API KEY is not correct'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $result = ($this->findOneByIdShopService)($auth->getProject(), $id);

        $data = $serializer->serialize($result, JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [],true);
    }
}
