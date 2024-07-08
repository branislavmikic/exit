<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is a dummy entity. Remove it!
 */
#[ApiResource(mercure: true)]
#[ORM\Entity]
class Reservation
{
    /**
     * The entity ID
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    private ?int $id = null;

    #[ORM\Column]
    public string $type = '';

    #[ORM\Column]
    public bool $confirmed = false;

    #[ORM\Column]
    public string $barcode = '';

    #[ORM\Column]
    public string $organisation = '';

    #[ORM\Column]
    public string $firstName = '';

    #[ORM\Column]
    public string $lastName = '';

    #[ORM\Column]
    public string $gender = '';

    #[ORM\Column]
    public string $registrationNumber = '';

    #[ORM\Column]
    public string $birth = '';

    #[ORM\Column]
    public string $personalNumber = '';

    #[ORM\Column]
    public string $city = '';

    #[ORM\Column]
    public string $country = '';

    public function getId(): ?int
    {
        return $this->id;
    }
}
