<?php

namespace App\State;

use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;

class ImportProcessor implements ProcessorInterface
{

    public function __construct(public EntityManagerInterface $entityManager) {
        
    }
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $file = fopen($data->file->getPathname(), 'r');

        $data = array();

        // 0 => "type"
        // 1 => "barcode"
        // 2 => "organisation"
        // 3 => "firstName"
        // 4 => "lastName"
        // 5 => "gender"
        // 6 => "registrationNumber"
        // 7 => "birth"
        // 8 => "personalNumber"
        // 9 => "city"
        // 10 => "country"

        while ($row = fgetcsv($file)) {
            $reservation = new Reservation();
            $reservation->type = $row[0];
            $reservation->confirmed = false;
            $reservation->barcode = $row[1];
            $reservation->organisation = $row[2];
            $reservation->firstName = $row[3];
            $reservation->lastName = isset($row[4]) ? $row[4] : '';
            $reservation->gender = isset($row[5]) ? $row[5]: '';
            $reservation->registrationNumber = isset($row[6]) ? $row[6]: '';
            $reservation->birth = isset($row[7]) ? $row[7] : '';
            $reservation->personalNumber = isset($row[8]) ? $row[8]: '';
            $reservation->city = isset($row[10]) ? $row[10] : '';
            $reservation->country = isset($row[9]) ? $row[9]: '';

            $this->entityManager->persist($reservation);
            $this->entityManager->flush();

        }

        fclose($file);
        return [];
    }
}
