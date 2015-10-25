# WvsCoreBundle
This bundle includes helpers, validators and most importantly an EntityRepository extension.

## EntityRepository
The Core\ORM\EntityRepository allows one to reuse chunks of Doctrine DQL prepared with the QueryBuilder. It is basically
just a wrapper with a queryBuilder property that allows one to build a query over multiple methods. The simple example
below shows how the code to join article categories is used by two public repository methods.
In this manner one can create and combine many methods that operate on the queryBuilder object.

```php
<?php

namespace Wvs\ArticleBundle\Entity;

use Wvs\CoreBundle\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{

    /**
     * @return \Wvs\ArticleBundle\Entity\Article[]
     */
    public function getAllWithCategories()
    {
        $this
            ->buildQueryStart('article')
            ->buildJoinCategories()
            ->getQueryBuilder()
                ->orderBy('article.dateFrom');

        return $this->getResult();
    }

    /**
     * @param $id
     * @return null | \Wvs\ArticleBundle\Entity\Article
     */
    public function getArticleWithCategory($id)
    {
        $result = $this
            ->buildQueryStart('article')
            ->buildJoinCategories()
            ->getResult();

        if (!empty($result)) {
            return $result[0];
        }

        return null;
    }

    protected function buildJoinCategories()
    {
        $this
            ->getQueryBuilder()
            ->addSelect('category')
            ->join('article.category', 'category');

        return $this;
    }

}

```