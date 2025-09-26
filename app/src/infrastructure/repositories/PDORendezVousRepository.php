<?php
declare(strict_types=1);

namespace toubilib\infrastructure\repositories;

use toubilib\core\domain\entities\rdv\RendezVous;
use toubilib\core\domain\entities\rdv\repositories\RendezVousRepositoryInterface;

final class PDORendezVousRepository implements RendezVousRepositoryInterface
{
    public function __construct(private \PDO $pdo) {}

    public function findById(string $id): ?RendezVous
    {
        $sql = "SELECT id, praticien_id, patient_id, patient_email,
                       date_heure_debut, date_heure_fin, motif_visite
                FROM public.rdv
                WHERE id = :id";
        $st = $this->pdo->prepare($sql);
        $st->execute([':id' => $id]);
        $r = $st->fetch(\PDO::FETCH_ASSOC);
        if (!$r) return null;

        return new RendezVous(
            (string)$r['id'],
            (string)$r['praticien_id'],
            new \DateTimeImmutable($r['date_heure_debut']),
            new \DateTimeImmutable($r['date_heure_fin']),
            $r['motif_visite'] ?? null,
            $r['patient_id'] ?? null,
            $r['patient_email'] ?? null,
        );
    }

    public function findBusyForPraticienBetween(string $praticienId, \DateTimeImmutable $from, \DateTimeImmutable $to): array
    {
        $sql = "SELECT id, praticien_id, patient_id, patient_email,
                       date_heure_debut, date_heure_fin, motif_visite
                FROM public.rdv
                WHERE praticien_id = :pid
                  AND date_heure_debut < :to
                  AND date_heure_fin   > :from
                ORDER BY date_heure_debut ASC";
        $st = $this->pdo->prepare($sql);
        $st->execute([
            ':pid'  => $praticienId,
            ':from' => $from->format('Y-m-d H:i:s'),
            ':to'   => $to->format('Y-m-d H:i:s'),
        ]);
        $rows = $st->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(fn($r) => new RendezVous(
            (string)$r['id'],
            (string)$r['praticien_id'],
            new \DateTimeImmutable($r['date_heure_debut']),
            new \DateTimeImmutable($r['date_heure_fin']),
            $r['motif_visite'] ?? null,
            $r['patient_id'] ?? null,
            $r['patient_email'] ?? null,
        ), $rows);
    }
}
