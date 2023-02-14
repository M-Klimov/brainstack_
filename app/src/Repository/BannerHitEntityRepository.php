<?php

namespace App\Repository;

use App\Entity\BannerHitEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BannerHitEntity>
 *
 * @method BannerHitEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method BannerHitEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method BannerHitEntity[]    findAll()
 * @method BannerHitEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BannerHitEntityRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BannerHitEntity::class);
    }

    public function addOrUpdateTimestamp(BannerHitEntity $bannerHitEntity): void
    {
        $connection = $this->getEntityManager()->getConnection();
        $query = $connection->prepare('INSERT INTO banner_hit (identifier, ip, user_agent, created_at, updated_at) 
                                    values (:identifier, :ip, :userAgent, :createdAt, :updatedAt)
                                    ON conflict (identifier) DO UPDATE SET updated_at=excluded.updated_at;');

        $query->executeQuery([
            'identifier' => $bannerHitEntity->getIdentifier(),
            'ip' => $bannerHitEntity->getIp(),
            'userAgent' => $bannerHitEntity->getUserAgent(),
            'createdAt' => $this->datetimeToString($bannerHitEntity->getCreatedAt()),
            'updatedAt' => $this->datetimeToString($bannerHitEntity->getUpdatedAt()),
        ]);
    }

    public function save(BannerHitEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BannerHitEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
