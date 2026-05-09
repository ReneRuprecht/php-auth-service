<?php

namespace App\Tests\Health\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthControllerTest extends WebTestCase
{
    public function testHealthController(): void
    {
        $client = static::createClient();
        $client->request('GET', '/health');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);

        $response = $client->getResponse();
        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('service', $data);
        $this->assertArrayHasKey('timestamp', $data);

        $this->assertEquals('ok', $data['status']);
        $this->assertEquals('auth-service', $data['service']);
    }
}
