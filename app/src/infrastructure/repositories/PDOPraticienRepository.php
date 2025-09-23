<?php
namespace toubilib\infrastructure\repositories;

use PDO;
use toubilib\core\domain\entities\praticien\Praticien;
use toubilib\core\domain\repositories\PraticienRepositoryInterface; 

final class PDOPraticienRepository implements PraticienRepositoryInterface
{
    public function __construct(private PDO $pdo) {}

    public function findAll(): array
    {
        $sql = "SELECT p.id, p.nom, p.prenom, p.ville, p.email, s.libelle AS specialite
                FROM praticien p
                JOIN specialite s ON s.id = p.id_specialite
                ORDER BY p.nom, p.prenom";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $list = [];
        foreach ($rows as $r) {
            $list[] = new Praticien(
                (int)$r['id'],
                (string)$r['nom'],
                (string)$r['prenom'],
                (string)$r['ville'],
                (string)$r['email'],
                (string)$r['specialite']
            );
        }
        return $list;
    }
}
