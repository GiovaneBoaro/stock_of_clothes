<?php
namespace APP\Model\DAO;
interface DAO{
    public function insert($object);
    public function update($object);
    public function findAll();
    public function findOne($barCode);
    public function delete($barCode);
}