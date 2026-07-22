<?php

namespace MoonfiveDev\ClientApi\Tests;

use GuzzleHttp\ClientInterface;
use InvalidArgumentException;
use MoonfiveDev\ClientApi\ClientApi;
use MoonfiveDev\ClientApi\ClientOptions;
use MoonfiveDev\ClientApi\MoonfiveClient;
use PHPUnit\Framework\TestCase;

class MoonfiveClientTest extends TestCase
{
    public function test_check_site_throws_clear_error_when_log_path_missing(): void
    {
        $http = $this->createMock(ClientInterface::class);
        // The guard must fire before any HTTP request is attempted.
        $http->expects($this->never())->method('request');

        $client = new MoonfiveClient(
            api: new ClientApi(secret: 'secret', client: $http),
            options: new ClientOptions(),
        );

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('ClientOptions::$logPath must be configured to use checkSite().');

        $client->checkSite(1);
    }
}
