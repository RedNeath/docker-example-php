<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Dto\HealthDto;

#[OA\Tag(name: 'Health')]
class HealthController extends AbstractController
{
    #[Route('/api/health', name: 'app_health', methods: ['GET'])]
    #[OA\Response(
        response: Response::HTTP_OK,
        description: 'Server health',
        content: new OA\JsonContent(ref: new Model(type: HealthDto::class))
    )]
    /**
     * Returns the server's health state.
     */
    public function getHealth(): JsonResponse
    {
        return $this->json(new HealthDto('Welcome to your new controller!', 'src/Controller/HealthController.php'));
    }

    #[Route('/api/health-report', name: 'app_health_report', methods: ['POST'])]
    #[OA\Response(
        response: Response::HTTP_NO_CONTENT,
        description: 'Email was sent to the maintainer'
    )]
    /**
     * Sends a health report to the maintainer by email.
     */
    public function sendHealthReport(MailerInterface $mailer): Response
    {
        $health = new HealthDto('Welcome to your new controller!', 'src/Controller/HealthController.php');
        $email = (new Email())
            ->from('server@docker-example-web.org')
            ->to('maintainer@docker-example-web.org')
            ->subject('SERVER HEALTH REPORT')
            ->html("<table><tbody><tr><td>Message</td><td>{$health->message}</td></tr><tr><td>Path</td><td>{$health->path}</td></tr></tbody></table>");
        
        $mailer->send($email);
        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
