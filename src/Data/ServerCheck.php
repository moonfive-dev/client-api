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

    public static function fromArray(array $data): ServerCheck
    {
        return new ServerCheck(
            disk_usage_percent: $data["disk_usage_percent"] ?? null,
        );
    }
}
