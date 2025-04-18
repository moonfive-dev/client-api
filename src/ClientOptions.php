<?php

namespace MoonfiveDev\ClientApi;

class ClientOptions
{
    public function __construct(
        public readonly ?string $logPath = null,
    ) {}
}
