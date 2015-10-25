<?php

namespace Wvs\CoreBundle\ORM;

use Doctrine\ORM\EntityRepository as ORMRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\AbstractQuery;

abstract class EntityRepository extends ORMRepository
{

    /** @var \Doctrine\ORM\QueryBuilder */
    protected $queryBuilder;

    /**
     * Initiate the queryBuilder object
     *
     * @param string
     * @return $this
     */
    protected function buildQueryStart($alias='a')
    {
        $this->queryBuilder = $this->createQueryBuilder($alias);

        return $this;
    }


    /**
     * Shortcut to get the Query object
     *
     * @return \Doctrine\ORM\Query
     */
    public function getQuery()
    {
        return $this->queryBuilder->getQuery();
    }

    /**
     * Get the QueryBuilder
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }

    /**
     * Shortcut to get the results
     *
     * @param int $hydrationMode
     * @return array
     */
    protected function getResult($hydrationMode = AbstractQuery::HYDRATE_OBJECT)
    {
        return $this
            ->getQuery()
            ->getResult($hydrationMode);
    }

    /**
     * Nice for debugging purposes
     *
     * @return string
     */
    public function getRawSql()
    {

        $query       = $this->getQuery();
        $params      = $query->getParameters();
        $dql = $query->getDQL();

        $dqlTemp = $dql;
        foreach ($params as $param) {
            if (is_numeric($param->getValue())) {
                $value = $param->getValue();
            } elseif (is_bool($param->getValue())) {
                $value = $param->getValue() * 1;
            } else {
                $value =  '\'' . $param->getValue() . '\'';
            }
            $dqlTemp = str_replace(':'.$param->getName(), $value, $dqlTemp);
        }

        // temporarly replace
        $query->setParameters(new ArrayCollection([]));
        $query->setDQL($dqlTemp);

        $sql = $query->getSQL();

        // back to normal
        $query->setParameters($params);
        $query->setDQL($dql);

        return $sql;

    }

}