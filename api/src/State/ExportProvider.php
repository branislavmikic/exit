<?php
namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\Reservation;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class ExportProvider implements ProviderInterface
{

    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
    }
    /**
     * @param Operation $operation
     * @param array $uriVariables
     * @param array $context
     * @return object|array|null
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {

        $data = $this->entityManager->getRepository(Reservation::class)->findAll();
        return $data;
    }
}
