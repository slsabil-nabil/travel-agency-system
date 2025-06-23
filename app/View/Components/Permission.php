<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Permission extends Component
{
    public string $ability;

    public function __construct(string $ability)
    {
        $this->ability = $ability;
    }

    public function render(): View
    {
        return view('components.permission');
    }
}
