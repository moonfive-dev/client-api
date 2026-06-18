<?php

namespace MoonfiveDev\ClientApi\Data;

class SiteCheck
{
    public function __construct(
        public readonly array $prev_error_logs = [],
        public readonly array $current_error_logs = [],
        public readonly int $prev_error_log_count = 0,
        public readonly int $current_error_log_count = 0,
    ) {}

    public function toArray(): array
    {
        return [
            "prev_error_logs" => $this->prev_error_logs,
            "current_error_logs" => $this->current_error_logs,
            "prev_error_log_count" => $this->prev_error_log_count,
            "current_error_log_count" => $this->current_error_log_count,
        ];
    }

    public static function fromArray(array $data): SiteCheck
    {
        return new SiteCheck(
            prev_error_logs: $data["prev_error_logs"] ?? [],
            current_error_logs: $data["current_error_logs"] ?? [],
            prev_error_log_count: $data["prev_error_log_count"] ?? 0,
            current_error_log_count: $data["current_error_log_count"] ?? 0,
        );
    }
}
