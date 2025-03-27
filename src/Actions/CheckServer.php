<?php

namespace MoonfiveDev\ClientApi\Actions;

use MoonfiveDev\ClientApi\Data\ServerCheck;

class CheckServer
{
    public function handle(): ServerCheck
    {
        return new ServerCheck(
            disk_usage_percent: $this->getDiskUsagePercent(),
        );
    }

    private function getDiskUsagePercent(): ?int
    {
        $disk_total_space = disk_total_space('/');
        $disk_free_space = disk_free_space('/');

        if ($disk_total_space === 0) {
            return null;
        }

        return round(($disk_total_space - $disk_free_space) / $disk_total_space * 100);
    }
}
