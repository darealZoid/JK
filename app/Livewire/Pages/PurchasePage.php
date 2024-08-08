<?php

namespace App\Livewire\Pages;



use App\Livewire\Components\PurchaseAndDeliveryManagement\Purchase\PurchaseOrderForm;
use Livewire\Component;

class PurchasePage extends Component
{

    public $isCreate;

    public $showModal = false;

    public function render()
    {
        return view('livewire.pages.purchase-page');
    }

    public function formCreate()
    {
        $this->dispatch('change-method', isCreate: true)->to(PurchaseOrderForm::class);
        $this->isCreate = !$this->isCreate;
    }

    public function formCancel()
    {
        $this->dispatch('change-method', isCreate: false)->to(PurchaseOrderForm::class);
        $this->isCreate = !$this->isCreate;
    }

    protected $listeners = [
        'close-modal' => 'closeModal',
        'change-method' => 'changeMethod',
    ];

    public function changeMethod($isCreate)
    {
        $this->isCreate = $isCreate; //var assign ang parameter value sa global variable
    }
}
