<?php

namespace MoonfiveDev\ClientApi\Data;

class ServerCheck
{
    public function __construct(
        public readonly ?int $disk_usage_percent = null,
    ) {}

    public function toArray(): array
    {
        return [
            "disk_usage_percent" => $this->disk_usage_percent,
        ];
    }
}
