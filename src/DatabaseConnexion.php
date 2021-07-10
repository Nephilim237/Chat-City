<?php
namespace Chat;

use PDO;
use PDOException;


class DatabaseConnexion
{
    protected PDO $connexion;

    private string $host = "mysql:dbname=web_soc_chat";
    private string $user = 'root';
    private string $password = 'root';

    /**
     * @return PDO
     */
    public function getDB(): PDO {
        try {
            $this->connexion = new PDO($this->host, $this->user, $this->password);
        } catch(PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }

        return $this->connexion;
    }
}