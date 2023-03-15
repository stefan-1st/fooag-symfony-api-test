<?php

namespace App\Extension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Adresse;
use App\Entity\Details;
use Doctrine\ORM\QueryBuilder;

class AdresseIsGeloeschtExtension implements QueryCollectionExtensionInterface
{
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        if ($resourceClass !== Adresse::class) {
            return;
        }

        $detailsAlias = 'details';
        $rootAlias = $queryBuilder->getRootAlias()[0];
        $queryBuilder->leftJoin(Details::class, $detailsAlias, 'WITH', sprintf('%s.adresse_id = %s.adresseId', $rootAlias, $detailsAlias));
        $queryBuilder->andWhere(sprintf('%s.geloescht = :isGeloescht', $detailsAlias));
        $queryBuilder->setParameter('isGeloescht', 0);
    }
}