<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PayButtonCollection extends Component
{
    /**
     * Create a new component instance.
     */
    public $deposit;
    public $paymentMethodType;


    public function __construct($deposit, $paymentMethodType)
    {
        $this->deposit = $deposit;
        $this->paymentMethodType = $paymentMethodType;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pay-button-collection');
    }
}
