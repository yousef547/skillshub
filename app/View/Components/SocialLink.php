<?php

namespace App\View\Components;

use App\Models\satting;
use Illuminate\View\Component;

class SocialLink extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */




    public function render()
    {   $data['satt'] = satting::select('facebook','twitter','instagram','youtube','linkedin')->first();
        return view('components.social-link')->with($data);
    }
}
