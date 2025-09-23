<?php
declare(strict_types=1);

namespace toubilib\infrastructure\repositories;

use PDO;
use toubilib\core\domain\entities\praticien\Praticien;


final class PDOPraticienRepository implements PraticienRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findAll(): array
    {
        $sql = "SELECT p.id, p.nom, p.prenom, p.ville, p.email, s.libelle AS specialite
                FROM praticien p
                JOIN specialite s ON s.id = p.specialite_id
                ORDER BY p.nom, p.prenom";

        $rows = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $list = [];
        foreach ($rows as $r) {
            $list[] = new Praticien(
                (int) $r['id'],
                (string) $r['nom'],
                (string) $r['prenom'],
                (string) $r['ville'],
                (string) $r['email'],
                (string) $r['specialite']
            );
        }
        return $list;
    }
}
