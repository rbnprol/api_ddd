<?php

namespace App\Product\Infrastructure\Controller;

use App\Auth\Application\AuthService;
use App\Product\Application\Find\FindAllProductsService;
use App\Product\Application\Find\FindOneProductByIdService;
use App\Product\Domain\Product;
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

#[Route('/products')]
#[OA\Tag(name: 'Products')]
#[Security(name: 'ApiKeyAuth')]
class ProductController extends AbstractController
{
    private AuthService $authService;
    private FindAllProductsService $findAllProductsService;
    private FindOneProductByIdService $findOneProductByIdService;

    public function __construct(
        AuthService $authService,
        FindAllProductsService $findAllProductsService,
        FindOneProductByIdService $findOneProductByIdService
    )
    {
        $this->authService = $authService;
        $this->findAllProductsService = $findAllProductsService;
        $this->findOneProductByIdService = $findOneProductByIdService;
    }

    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Successful response',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Product::class))
        )
    )]
    public function getProducts(SerializerInterface $serializer, Request $request): JsonResponse
    {
        if(!$auth = ($this->authService)($request->headers->get($this->getParameter('nameToken')))) {
            return new JsonResponse([
                'message' => 'API KEY is not correct'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $result = ($this->findAllProductsService)($auth->getProject());

        $data = $serializer->serialize($result, JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [],true);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Successful response',
        content: new OA\JsonContent(
            ref: new Model(type: Product::class)
        )
    )]
    #[OA\Parameter(
        name: 'id',
        description: 'Product ID',
        in: 'path',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    public function getProductById(SerializerInterface $serializer, Request $request, int $id): JsonResponse
    {
        if(!$auth = ($this->authService)($request->headers->get($this->getParameter('nameToken')))) {
            return new JsonResponse([
                'message' => 'API KEY is not correct'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $result = ($this->findOneProductByIdService)($auth->getProject(), $id);

        $data = $serializer->serialize($result, JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [],true);
    }

}
