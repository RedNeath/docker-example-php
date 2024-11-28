<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Dto\HealthDto;

#[OA\Tag(name: 'Health')]
class HealthController extends AbstractController
{
    #[Route('/api/health', name: 'app_health', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Server health',
        content: new OA\JsonContent(ref: new Model(type: HealthDto::class))
    )]
    /**
     * Returns the server's health state.
     */
    public function index(): JsonResponse
    {
        return $this->json(new HealthDto('Welcome to your new controller!', 'src/Controller/HealthController.php'));
    }
}
