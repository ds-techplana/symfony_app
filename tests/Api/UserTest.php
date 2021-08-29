<?php

namespace App\Api\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class UserTest extends WebTestCase
{
    /**
     * @var KernelBrowser|null
     */
    private ?KernelBrowser $client = null;

    protected function setUp(): void
    {
        $this->client = static::createClient(['environment' => 'dev']);
        $this->client->disableReboot();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testCreateUserApiWillAlwaysReturnOk()
    {
        $headers = array_merge(['Accept' => 'application/json', 'Content-Type' => 'application/json']);

        $this->client->request('post', '/user/create',  [
            'name' => 'asaasdas',
            'email' => 'email@emai.com',
            'role' => 1,
        ], [], $headers);

        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
    }
}
