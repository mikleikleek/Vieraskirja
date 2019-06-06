<?php


class Kommentit extends Oamk\baseClass {
    
    function uusi($id, $nimi, $email, $viesti) {
        
        $sql = "INSERT INTO kommentit (vieraskirja_id, nimi, email, viesti, ip) VALUES (:vieraskirja_id, :nimi, :email, :viesti, :ip)";

        $sql = $this->db->parseSql($sql);

        $bind = [
            ':vieraskirja_id'   => strip_tags(trim($id)),
            ':nimi'             => strip_tags(trim($nimi)),
            ':email'            => strip_tags(trim($email)),
            ':viesti'           => strip_tags(trim($viesti)),
            ':ip'               => $this->haeIp()
        ];

        if(!$this->db->doBindSql($bind, $sql)) {
            print $this->db->getError();
            die();
        }
        
        return $this->db->getLastInsertId();
    }
    
    
    function hae($vieraskirja_id = 0, $kommentit_id = 0) {
        
        
        $sql = "SELECT * FROM kommentit ";
        
        if ($vieraskirja_id) {
            $sql .= " WHERE vieraskirja_id = :id ";
            $bind[':id'] = $vieraskirja_id;
        }
        
        if ($kommentit_id) {
            $sql .= " WHERE kommentit_id = :id ";
            $bind[':id'] = $kommentit_id;
        }
        
        $sql .= " ORDER by id";
       
        $sql = $this->db->parseSql($sql);
        
        if(!$this->db->doBindSql($bind, $sql)) {
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
        
        $sql = "SELECT * FROM kommentit LIMIT :numero_menossa, :yhden_sivun_maara";
    
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