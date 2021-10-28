<?php

class Zene{
    private $id;
    private $cim;
    private $eloado;
    private $stilus;
    private $hossz;
    private $megjelenes_datuma;

    public function __construct(string $cim, string $eloado,string $stilus, float $hossz, DateTime $megjelenes_datuma){
        $this->cim = $cim;
        $this->eloado = $eloado;
        $this->stilus = $stilus;
        $this->hossz = $hossz;
        $this->megjelenes_datuma = $megjelenes_datuma;

    }
    
    public function uj() {
        global $db;

        $db->prepare('INSERT INTO zenek (cim, eloado, stilus, hossz, megjelenes_datuma)
                    VALUES (:cim, :eloado, :stilus, :hossz, :megjelenes_datuma)')
            ->execute([
                ':cim' => $this->cim,
                ':eloado' => $this->eloado,
                ':stilus' => $this->stilus,
                ':hossz' => $this->hossz,
                ':megjelenes_datuma' => $this->megjelenes_datuma->format('Y-m-d'),
            ]);
    }

    public function getId() : ?int {
        return $this->id;
    }

    public function getCim() : string {
        return $this->cim;
    }
    public function setCim(string $cim) : void  {
        $this->cim = $cim;
    }


    public function getEloado() : string {
        return $this->eloado;
    }
    public function setEloado(string $eloado) : void  {
        $this->eloado = $eloado;
    }


    public function getStilus() : string {
        return $this->stilus;
    }
    public function setStilus(string $stilus) : void  {
        $this->stilus = $stilus;
    }

    
    public function getHossz() : float {
        return $this->hossz;
    }
    public function setHossz(float $hossz) : void  {
        $this->hossz = $hossz;
    }


    public function getMegjelenesDatuma() : DateTime {
        return $this->megjelenes_datuma;
    }
    public function setMegjelenesDatuma(DateTime $megjelenes_datuma) : void {
        $this->megjelenes_datuma = $megjelenes_datuma;
    }


    public static function torol(int $id) {
        global $db;

        $db->prepare('DELETE FROM zenek WHERE id = :id')
            ->execute([':id' => $id]);
    }

    public static function osszes() : array {
        global $db;

        $t = $db->query("SELECT * FROM zenek ORDER BY cim ASC")
                ->fetchAll();
        $eredmeny = [];

        foreach ($t as $elem) {
            $zene = new Zene($elem['cim'],
                             $elem['eloado'],
                             $elem['stilus'],
                             $elem['hossz'],
                    new DateTime($elem['megjelenes_datuma']));
            $zene->id = $elem['id'];
            $eredmeny[] = $zene;
        }

        return $eredmeny;
    }

    public static function getById(int $id) : Zene {
        global $db;

        $stmt = $db->prepare('SELECT * FROM zenek WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $eredmeny = $stmt->fetchAll();

        if (count($eredmeny) !== 1) {
            throw new Exception('A DB lekerdezes nem egy sort adott vissza');
        }

        $zene = new Zene(
            $eredmeny[0]['cim'],
            $eredmeny[0]['eloado'],
            $eredmeny[0]['stilus'],
            $eredmeny[0]['hossz'],
            new DateTime($eredmeny[0]['megjelenes_datuma'])
        );
        $zene->id = $eredmeny[0]['id'];
        return $zene;
    }

    public function mentes() {
        global $db;

        $db->prepare('UPDATE zenek SET cim = :cim, eloado = :eloado, stilus = :stilus, hossz = :hossz, megjelenes_datuma = :megjelenes_datuma
            WHERE id = :id')
            ->execute([
                ':id' => $this->id,
                ':cim' => $this->cim,
                ':eloado' => $this->eloado,
                ':stilus' => $this->stilus,
                ':hossz' => $this->hossz,
                ':megjelenes_datuma' => $this->megjelenes_datuma->format('Y-m-d'),
            ]);
    }
}