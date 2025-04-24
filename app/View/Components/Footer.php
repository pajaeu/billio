<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Services\Git;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

final class Footer extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $version = Cache::remember('git-latest-tag', 3600, fn () => app(Git::class)->getLatestReleaseTag());

        return view('components.footer', [
            'version' => $version,
        ]);
    }
}
