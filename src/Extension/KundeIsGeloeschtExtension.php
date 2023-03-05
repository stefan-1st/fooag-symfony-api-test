<?php

namespace App\Extension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Kunde;
use Doctrine\ORM\QueryBuilder;

class KundeIsGeloeschtExtension implements \ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface
{

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        if ($resourceClass !== Kunde::class) {
            return;
        }

        $rootAlias = $queryBuilder->getRootAlias()[0];
        $queryBuilder->andWhere(sprintf('%s.geloescht = :isGeloescht', $rootAlias));
        $queryBuilder->setParameter('isGeloescht', 0);
    }
}