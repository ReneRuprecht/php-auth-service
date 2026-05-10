<?php

namespace App\Tests\Auth\Infrastructure\Doctrine;

use App\Auth\Domain\User;
use App\Auth\Domain\UserEmail;
use App\Auth\Domain\UserID;
use App\Auth\Domain\UserPassword;
use App\Auth\Infrastructure\Doctrine\DoctrineUserRepository;
use App\Auth\Infrastructure\Doctrine\UserEntity;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

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

        $uid = UserID::newUserID();
        $email = UserEmail::fromString($uid->value().'@example.com');
        $password = UserPassword::fromHash('password');
        $user = new User($uid, $email, $password);
        $repo->save($user);

        $found = $this->em->getRepository(UserEntity::class)->findOneBy(['email' => $email->value()]);
        self::assertNotNull($found);
    }
}
