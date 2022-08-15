<?php

namespace APP\Model\DAO;

use APP\Model\Connection;
use PDO;

//ProductDAO Ok
class ProductDAO implements DAO
{
    public function insert($object)
    {
        $connection = Connection::getConnection();
        $stmt = $connection->prepare('INSERT INTO clothes VALUES(?,?, ?, ?, ?, ?);');
        $stmt->bindParam(1, $object->barCode);
        $stmt->bindParam(2, $object->price);
        $stmt->bindParam(3, $object->size);
        $stmt->bindParam(4, $object->quantity);
        $stmt->bindParam(5, $object->tipo);
        $stmt->bindParam(6, $object->color);
        return $stmt->execute();
    }
    public function update($object)
    {
        $connection = Connection::getConnection();
        $stmt = $connection->prepare('UPDATE clothes SET price=?, size=?, quantity=?, tipo=?, color=? WHERE barCode=?;');
        $stmt->bindParam(1, $object->price);
        $stmt->bindParam(2, $object->size);
        $stmt->bindParam(3, $object->quantity);
        $stmt->bindParam(4, $object->tipo);
        $stmt->bindParam(5, $object->color);
        $stmt->bindParam(6, $object->barCode);
        return $stmt->execute();
    }
    public function findAll()
    {
        $connection = Connection::getConnection();
        $rs = $connection->query('select * from clothes');
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findOne($barCode)
    {
        $connection = Connection::getConnection();
        //Problema na linha 42
        $rs = $connection->query("select * from clothes where barCode = $barCode");
        return $rs->fetch(PDO::FETCH_ASSOC);
    }
    public function delete($barCode)
    {
        $connection = Connection::getConnection();
        $stmt = $connection->prepare('delete from clothes where barCode = ?');
        $stmt->bindParam(1, $barCode);
        return $stmt->execute();
    }
}
