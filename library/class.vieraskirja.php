<?php


class vieraskirja extends Oamk\baseClass {
    
    function uusi($nimi, $email, $viesti) {
        
        $sql = "INSERT INTO vieraskirja (nimi, email, viesti, ip) VALUES (:nimi, :email, :viesti, :ip)";

        $sql = $this->db->parseSql($sql);

        $bind = [
            ':nimi'     => strip_tags(trim($nimi)),
            ':email'    => strip_tags(trim($email)),
            ':viesti'   => strip_tags(trim($viesti)),
            ':ip'       => $this->haeIp()
        ];

        if(!$this->db->doBindSql($bind, $sql)) {
            print $this->db->getError();
            die();
        }
        
        return $this->db->getLastInsertId();
    }
    
    
    function hae() {
        
        $sql = "SELECT * FROM vieraskirja ORDER by id";
       
        if(!$this->db->doSql($sql)) {
            print $this->db->getError();
            die();
        }

        $result = $this->db->getResultsAssoc();
        return $result;
    }

    
    function haeIp() {
        
        $ip = $_SERVER['REMOTE_ADDR'];
        return $ip;
    }
    
    
    function laske() {
        
        $kaikki = $this->hae();
        $numero = count($kaikki);
        return $numero;
    }
    
    function haeKymmenen($limit1, $limit2) {
        
        $sql = "SELECT * FROM vieraskirja LIMIT :numero_menossa, :yhden_sivun_maara";
    
        $sql = $this->db->parseSql($sql);
        
        $bind = [
            ':numero_menossa'       => $limit1,
            ':yhden_sivun_maara'    => $limit2
        ];
        
        $cast = [
            ':numero_menossa'    => PDO::PARAM_INT,
            ':yhden_sivun_maara'    => PDO::PARAM_INT
        ];

        if(!$this->db->doBindSql($bind, $sql, $cast)) {
            print $this->db->getError();
            die();
        }
        
        $result = $this->db->getResultsAssoc();
        return $result;
    }
}