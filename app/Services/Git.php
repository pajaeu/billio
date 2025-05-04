<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Process;

final class Git
{
    public function getLatestReleaseTag(): string
    {
        return mb_trim(
            Process::path(base_path())->run(['git', 'describe', '--tags', '--abbrev=0'])->output(),
        );
    }
}
