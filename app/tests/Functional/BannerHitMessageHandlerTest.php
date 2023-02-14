<?php

namespace App\Tests\Functional;

use App\Entity\BannerHitEntity;

class BannerHitMessageHandlerTest extends AbstractTestCase
{
    public function test(): void
    {
        $kernel = self::bootKernel();
        $bus = $this->getBus($kernel);
        $em = $this->getEntityManager($kernel);

        $entity = $this->getBannerHitEntity();
        $dbEntity = $em->getRepository(BannerHitEntity::class)->findOneBy(['identifier' => $entity->getIdentifier()]);
        $this->assertNull($dbEntity); // test entity must not be in the DB before dispatching

        $bus->dispatch($entity);
        sleep(5);

        $dbEntity = $em->getRepository(BannerHitEntity::class)->findOneBy(['identifier' => $entity->getIdentifier()]);

        $this->assertSame($entity->getUserAgent(), $dbEntity->getUserAgent());
        $this->assertSame($entity->getIp(), $dbEntity->getIp());
        $this->assertSame($entity->getCreatedAt()->getTimestamp(), $dbEntity->getCreatedAt()->getTimestamp());
        $this->assertSame($entity->getUpdatedAt()->getTimestamp(), $dbEntity->getUpdatedAt()->getTimestamp());

        $newEntity = $this->getBannerHitEntity(); // the same but with different timestamps

        $bus->dispatch($newEntity);
        sleep(5);

        $em->clear();
        $dbEntity = $em->getRepository(BannerHitEntity::class)->findOneBy(['identifier' => $entity->getIdentifier()]);

        // check that updatedAt timestamp is new, but all other data are the same
        $this->assertSame($entity->getUserAgent(), $dbEntity->getUserAgent());
        $this->assertSame($entity->getIp(), $dbEntity->getIp());
        $this->assertSame($entity->getCreatedAt()->getTimestamp(), $dbEntity->getCreatedAt()->getTimestamp());
        $this->assertSame($newEntity->getUpdatedAt()->getTimestamp(), $dbEntity->getUpdatedAt()->getTimestamp());


        $em->remove($dbEntity);
        $em->flush();
    }


    private function getBannerHitEntity(): BannerHitEntity
    {
        $entity = new BannerHitEntity();
        $entity->setIp('127.0.0.1');
        $entity->setUserAgent('Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 phpunit');
        $entity->computeIdentifier();

        return $entity;
    }
}
