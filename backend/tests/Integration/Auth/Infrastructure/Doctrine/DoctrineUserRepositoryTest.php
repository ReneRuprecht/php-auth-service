<?php

namespace App\Tests\Auth\Infrastructure\Doctrine;

use App\Auth\Domain\User;
use App\Auth\Infrastructure\Doctrine\DoctrineUserRepository;
use App\Auth\Infrastructure\Doctrine\UserEntity;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Uid\Uuid;

class DoctrineUserRepositoryTest extends KernelTestCase
{

  private ?EntityManager $em;

  protected function setUp(): void
  {
    $kernel = self::bootKernel();
    $this->em = $kernel->getContainer()->get('doctrine')->getManager();
  }

  public function testSave(): void
  {
    $repo = self::getContainer()->get(DoctrineUserRepository::class);

    $uid = Uuid::v7();
    $email = $uid . '@example.com';
    $user = new User($uid, $email, 'password');
    $repo->save($user);

    $found = $this->em->getRepository(UserEntity::class)->findOneBy(['email' => $email]);
    self::assertNotNull($found);
  }
}
