<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Vermittler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

/**
 * This class adds business logic to the Kunde entity.
 *
 * Basically it makes sure that if a Kunde is saved the actually logged in Vermittler is set.
 * Also, the UUID is generated before creation.
 */
class KundeDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var ContextAwareDataPersisterInterface
     */
    private $decorated;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ContextAwareDataPersisterInterface $decorated, EntityManagerInterface $entityManager)
    {
        $this->decorated = $decorated;
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return $this->decorated->supports($data, $context);
    }

    /**
     * @inheritDoc
     */
    public function persist($data, array $context = [])
    {
        if ($context['collection_operation_name'] === 'post') {
            // @todo This has to be replaced with the logged in vermittlerId.
            $vermittler = $this->entityManager->find(Vermittler::class, 1000);
            $data->setVermittler($vermittler);
            $data->setId(substr(Uuid::v4()->toBase32(), 0, 8));
        }

        return $this->decorated->persist($data, $context);
    }

    /**
     * @inheritDoc
     */
    public function remove($data, array $context = [])
    {
        $this->decorated->remove($data, $context);
    }
}