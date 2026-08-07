<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // Changé de 'layouts.app' vers 'layouts.authenticated'
        // pour ne plus entrer en conflit avec le layout public KANTSA.
        return view('layouts.authenticated');
    }
}
