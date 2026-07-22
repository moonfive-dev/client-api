<?php

namespace MoonfiveDev\ClientApi\Tests;

use InvalidArgumentException;
use MoonfiveDev\ClientApi\ClientOptions;
use PHPUnit\Framework\TestCase;

class ClientOptionsTest extends TestCase
{
    public function test_require_log_path_returns_configured_path(): void
    {
        $options = new ClientOptions(logPath: '/var/log/laravel');

        $this->assertSame('/var/log/laravel', $options->requireLogPath());
    }

    public function test_require_log_path_throws_when_null(): void
    {
        $options = new ClientOptions();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('ClientOptions::$logPath must be configured to use checkSite().');

        $options->requireLogPath();
    }

    public function test_require_log_path_throws_when_empty_string(): void
    {
        $options = new ClientOptions(logPath: '   ');

        $this->expectException(InvalidArgumentException::class);

        $options->requireLogPath();
    }
}
