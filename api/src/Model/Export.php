<?php

namespace App\Model;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\State\ExportProvider;

#[ApiResource(formats: ['jsonld', 'csv' => ['text/csv']],
    operations: [
        new Get(
            uriTemplate: "reservations-export",
            openapiContext: [
                'tags' => ['Reservation'],
                'description' => 'Reservations export',
            ],
            description: "Reservation Export",
            provider: ExportProvider::class,
            
        ),
    ],
)]
final class Export {
}
