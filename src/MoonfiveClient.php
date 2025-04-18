<?php

namespace MoonfiveDev\ClientApi;

use MoonfiveDev\ClientApi\Actions\CheckServer;
use MoonfiveDev\ClientApi\Actions\CheckSite;
use MoonfiveDev\ClientApi\Actions\GetLog;

class MoonfiveClient
{
    public function __construct(
        public readonly ClientApi $api,
        public readonly ClientOptions $options,
    ) {}

    public function checkServer(int $server_id): array
    {
        return $this->api->checkServer($server_id, (new CheckServer)->handle());
    }

    public function checkSite(int $site_id): array
    {
        return $this->api->checkSite($site_id, (new CheckSite(
            new GetLog($this->options->logPath)
        ))->handle());
    }
}
