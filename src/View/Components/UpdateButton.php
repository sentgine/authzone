<?php

namespace Sentgine\Authzone\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Sentgine\Authzone\Traits\Config;

class UpdateButton extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view(authzone_component_path('update-button'));
    }
}
