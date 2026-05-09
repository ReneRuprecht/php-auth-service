<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

class AuthControllerTest extends WebTestCase
{

  public function testAuthController(): void
  {
    $client = static::createClient();

    $email = Uuid::v7() . "@example.com";
    $client->request(
      'POST',
      'api/v1/register',
      [],
      [],
      ['CONTENT_TYPE' => 'application/json'],
      json_encode([
        'email' => $email,
        'password' => 'password'
      ])
    );

    $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);

    $this->assertJsonStringEqualsJsonString(
      json_encode([
        'status' => 'created'
      ]),
      $client->getResponse()->getContent()
    );
  }
}
