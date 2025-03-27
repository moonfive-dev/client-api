<?php

namespace MoonfiveDev\ClientApi\Data;

class SiteCheck
{
    public function __construct(
        public readonly ?int $prev_error_log_count = null,
        public readonly ?int $current_error_log_count = null,
    ) {}

    public function toArray(): array
    {
        return [
            "prev_error_log_count" => $this->prev_error_log_count,
            "current_error_log_count" => $this->current_error_log_count,
        ];
    }
}
