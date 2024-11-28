<?php

namespace App\Dto;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'HealthDto',
    description: 'Health status of the server'
)]
class HealthDto
{
    #[OA\Property(description: 'A message describing the health status', type: 'string')]
    public string $message;

    #[OA\Property(description: 'The path to the controller that sent the response', type: 'string')]
    public string $path;

    public function __construct(string $message, string $path)
    {
        $this->message = $message;
        $this->path = $path;
    }
}
