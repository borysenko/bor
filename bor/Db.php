<?php
namespace bor;

use Doctrine\ORM\EntityManager;

Class DB{

    public static $entityManager = null;

    public static function entityManager()
    {
        return self::$entityManager;
    }

    public static function setEntityManager(EntityManager $entityManager) : void
    {
        self::$entityManager = $entityManager;
    }
}