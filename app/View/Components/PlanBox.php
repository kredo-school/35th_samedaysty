<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PlanBox extends Component
{
    public string $title;
    public $plans;

    public function __construct(string $title, $plans)
    {
        $this->title = $title;
        $this->plans = $plans;
    }

    public function render(): View|Closure|string
    {
        return view('components.plan-box');
    }
}
