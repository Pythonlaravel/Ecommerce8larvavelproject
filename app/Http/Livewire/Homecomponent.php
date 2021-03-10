<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Homecomponent extends Component
{
    public function render()
    {
        $sliders = HomeSlider::where('status',1)->get();
        return view('livewire.HomeComponent',['sliders'=>$sliders])->layout("layouts.base");
    }
}
