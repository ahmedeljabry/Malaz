<?php

namespace App\View\Components\Seo;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Meta extends Component
{
    /**
     * @var array<string,mixed>
     */
    public array $data;

    /**
     * Create a new component instance.
     *
     * @param array<string,mixed> $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function render(): View|Closure|string
    {
        return view('components.seo.meta');
    }
}

