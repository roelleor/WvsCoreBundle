<?php

namespace Wvs\CoreBundle\Helper;

use Symfony\Bridge\Doctrine\ManagerRegistry;

class DatabaseHelper
{

    /**
     * @var ManagerRegistry
     */
    protected $doctrine;

    /**
     * @param $doctrine
     */
    function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function truncateByClassName($className)
    {
        $em = $this->doctrine->getManager();
        $cmd = $em->getClassMetadata($className);
        $connection = $em->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $q = $dbPlatform->getTruncateTableSql($cmd->getTableName());
        $connection->executeUpdate($q);
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
    }




}
