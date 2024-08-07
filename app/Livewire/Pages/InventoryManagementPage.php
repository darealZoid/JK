<?php

namespace App\Livewire\Pages;

use App\Livewire\Components\InventoryManagement\InventoryForm;
use Livewire\Component;

class InventoryManagementPage extends Component
{
    public $showModal = false;

    public $showStockAdjustModal = false;
    public $sidebarStatus;
    public function render()
    {
        return view('livewire.pages.inventory-management-page');
    }

    protected $listeners = [
        'close-modal' => 'closeModal',
        'change-sidebar-status' => 'changeSidebarStatus'
    ];

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function formCreate()
    {
        $this->dispatch('change-method', isCreate: true)->to(InventoryForm::class);
    }

    public function changeSidebarStatus($sidebarOpen)
    {
        $this->sidebarStatus = $sidebarOpen;
    }
}
