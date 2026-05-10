<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

class LoginControllerTest extends WebTestCase
{
    public function testLoginController(): void
    {
        $client = static::createClient();

        $id = Uuid::v7();
        $email = $id.'@example.com';

        $client->request(
            'POST',
            '/api/v1/register',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'email' => $email,
                'password' => 'password',
            ])
        );
        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);

        $client->request(
            'POST',
            '/api/v1/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'email' => $email,
                'password' => 'password',
            ])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('token', $response);
        $this->assertNotEmpty($response['token']);
    }

    public function testLoginControllerReturns404IfUserNotFound(): void
    {
        $client = static::createClient();

        $id = Uuid::v7();
        $email = $id.'@example.com';

        $client->request(
            'POST',
            '/api/v1/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'email' => $email,
                'password' => 'password',
            ])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    public function testLoginControllerReturns403IfInvalidCredentials(): void
    {
        $client = static::createClient();

        $id = Uuid::v7();
        $email = $id.'@example.com';

        $client->request(
            'POST',
            '/api/v1/register',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'email' => $email,
                'password' => 'password',
            ])
        );

        $client->request(
            'POST',
            '/api/v1/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'email' => $email,
                'password' => 'invalid',
            ])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }
}
