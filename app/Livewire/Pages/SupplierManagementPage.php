<?php

namespace App\Livewire\Pages;

use App\Livewire\Components\SupplierManagement\SupplierForm;
use Livewire\Component;

class SupplierManagementPage extends Component
{

    public $showModal = false;

    public $sidebarStatus;

    public function render()
    {
        return view('livewire.pages.supplier-management-page');
    }

    protected $listeners = [
        'close-modal' => 'closeModal',
        'change-sidebar-status' => 'changeSidebarStatus'
        ];

    public function closeModal(){
        $this->showModal = false;
    }

    public function formCreate()
    {
        $this->dispatch('change-method', isCreate: true)->to(SupplierForm::class);
    }

    public function changeSidebarStatus($sidebarOpen)
    {
       $this->sidebarStatus = $sidebarOpen;
    }
}
