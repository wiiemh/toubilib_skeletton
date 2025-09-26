<?php

declare(strict_types=1);

namespace toubilib\core\application\usecases;

use toubilib\core\application\dto\InputRendezVousDTO;
use toubilib\core\domain\entities\rdv\RendezVous;
use toubilib\core\domain\entities\rdv\repositories\RendezVousRepositoryInterface;
use toubilib\core\domain\entities\praticien\repositories\PraticienRepositoryInterface;
use Exception;

class ServiceRendezVous implements ServiceRendezVousInterface
{
    public function __construct(
        private PraticienRepositoryInterface $praticienRepository,
        private RendezVousRepositoryInterface $rdvRepository
    ) {
    }

    public function creerRendezVous(InputRendezVousDTO $dto): void
    {
        // 1. Vérifier que le praticien existe
        $praticien = $this->praticienRepository->findById($dto->praticienId);
        if (!$praticien) {
            throw new Exception("Praticien inexistant.");
        }

        // 3. Vérifier que le motif est valide pour ce praticien
        if ($dto->motif && !in_array($dto->motif, $praticien->getMotifs())) {
            throw new Exception('Motif non autorisé pour ce praticien');
        }

        // 4. Vérifier que le créneau horaire est valide (lundi-vendredi, 8h-19h)
        $debut = new \DateTimeImmutable($dto->debut);
        $fin = new \DateTimeImmutable($dto->fin);

        $jourSemaine = (int) $debut->format('N'); // 1 = lundi, 7 = dimanche
        $heureDebut = (int) $debut->format('H');
        $heureFin = (int) $fin->format('H');

        if ($jourSemaine > 5) {
            throw new Exception("Le rendez-vous doit être pris un jour ouvré (lundi à vendredi).");
        }
        if ($heureDebut < 8 || $heureFin > 19 || $fin <= $debut) {
            throw new Exception("L'horaire du rendez-vous doit être entre 8h et 19h, et la fin après le début.");
        }

        // 5. Vérifier la disponibilité du praticien
        $rdvsOccupes = $this->rdvRepository->findBusyForPraticienBetween(
            $dto->praticienId,
            $debut,
            $fin
        );
        if (count($rdvsOccupes) > 0) {
            throw new Exception("Le praticien n'est pas disponible sur ce créneau.");
        }

        // 6. Créer et sauvegarder le rendez-vous
        $rdv = new RendezVous(
            $dto->id,
            $dto->praticienId,
            $debut,
            $fin,
            $dto->motif,
            $dto->patientId,
            $dto->patientEmail
        );

        $this->rdvRepository->save($rdv);
    }
}