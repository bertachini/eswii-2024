<?php
namespace DAO;

use models\Prospect;
use Exception;
require_once 'configdb.php';

class DAOProspect {
    public function insertProspect(Prospect $prospect) {
        $connection = conectarDB();

        $sql = $connection->prepare("INSERT INTO prospects (codigo, nome, email, celular, facebook, whatsapp) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param("isssss", $prospect->codigo, $prospect->nome, $prospect->email, $prospect->celular, $prospect->facebook, $prospect->whatsapp);

        $result = $sql->execute();

        $sql->close();
        $connection->close();

        return $result;
    }

    public function getProspectByCode($codigo) {
        $connection = conectarDB();

        $sql = $connection->prepare("SELECT codigo, nome, email, celular, facebook, whatsapp FROM prospects WHERE codigo = ?");
        $sql->bind_param("i", $codigo);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows === 0) {
            return null;
        }

        $row = $result->fetch_assoc();
        $prospect = new Prospect();
        $prospect->addProspect($row['codigo'], $row['nome'], $row['email'], $row['celular'], $row['facebook'], $row['whatsapp']);

        $sql->close();
        $connection->close();

        return $prospect;
    }

    public function updateProspect(Prospect $prospect) {
        $connection = conectarDB();

        $sql = $connection->prepare("UPDATE prospects SET nome = ?, email = ?, celular = ?, facebook = ?, whatsapp = ? WHERE codigo = ?");
        $sql->bind_param("sssssi", $prospect->nome, $prospect->email, $prospect->celular, $prospect->facebook, $prospect->whatsapp, $prospect->codigo);

        $result = $sql->execute();

        $sql->close();
        $connection->close();

        return $result;
    }

    public function deleteProspect($codigo) {
        $connection = conectarDB();

        $sql = $connection->prepare("DELETE FROM prospects WHERE codigo = ?");
        $sql->bind_param("i", $codigo);

        $result = $sql->execute();

        $sql->close();
        $connection->close();

        return $result;
    }
}

