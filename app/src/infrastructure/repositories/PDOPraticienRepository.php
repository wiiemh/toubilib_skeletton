<?php
declare(strict_types=1);

namespace toubilib\infrastructure\repositories;

use toubilib\core\domain\entities\praticien\Praticien;
use toubilib\core\domain\entities\praticien\repositories\PraticienRepositoryInterface;

final class PDOPraticienRepository implements PraticienRepositoryInterface
{
    public function __construct(private \PDO $pdo)
    {
    }

    public function findAll(): array
    {
        $sql = "SELECT p.id, p.nom, p.prenom, p.ville, p.email, s.libelle AS specialite, m.libelle AS motif
                FROM public.praticien p
                JOIN public.specialite s ON s.id = p.specialite_id
                LEFT JOIN public.praticien_motif pm ON pm.praticien_id = p.id
                ORDER BY p.nom, p.prenom";
        $rows = $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(fn(array $r) => new Praticien(
            (string) $r['id'],
            (string) $r['nom'],
            (string) $r['prenom'],
            (string) $r['ville'],
            (string) $r['email'],
            (string) $r['specialite'],
            (array) $r['motif'],
        ), $rows);
    }

    public function findById(string $id): ?Praticien
    {
        $sql = "SELECT p.id, p.nom, p.prenom, p.ville, p.email, s.libelle AS specialite, m.libelle AS motif
                FROM public.praticien p
                JOIN public.specialite s ON s.id = p.specialite_id
                LEFT JOIN public.praticien_motif pm ON pm.praticien_id = p.id
                WHERE p.id = :id";
        $st = $this->pdo->prepare($sql);
        $st->execute([':id' => $id]);
        $r = $st->fetch(\PDO::FETCH_ASSOC);

        return $r ? new Praticien(
            (string) $r['id'],
            (string) $r['nom'],
            (string) $r['prenom'],
            (string) $r['ville'],
            (string) $r['email'],
            (string) $r['specialite'],
            (array) $r['motif'],
        ) : null;
    }
}
