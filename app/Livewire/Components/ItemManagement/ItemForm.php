<?php

namespace App\Livewire\Components\ItemManagement;

use App\Livewire\Pages\ItemManagementPage;
use App\Models\Item;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ItemForm extends Component
{
    use LivewireAlert;
    //var null muna silang lahat hanggat d narerender
    public $vatType = null;


    public $item_id, $barcode, $item_name, $item_description, $maximum_stock_ratio = 1.5, $reorder_point, $vat_amount, $status; //var form inputs
    public $vat_amount_enabled = false; //var diasble and vat amount by default
    public $proxy_item_id;  //var proxy id para sa supplier id, same sila ng value ng supplier id
    public $isCreate; //var true for create false for edit

    public function render()
    {
        if ($this->item_id) {

            $this->populateForm();
            $this->item_id = null;  //var null the item id kasi pag nag render ulit yung selection nirerepopulate nya yung mga fields gamit yung item id so i null para d ma repopulate kasi walang id and hindi mapalitan yung current na inpuuted value sa mga fields

        }

        return view('livewire.components.ItemManagement.item-form')->with($this->barcode);
    }
    protected $listeners = [
        'edit-item-from-table' => 'edit',  //* key:'edit-item-from-table' method:'edit'  galing sa ItemTable class
        //* key:'change-method' value:'changeMethod' galing sa ItemTable class,  laman false
        'change-method' => 'changeMethod',
        'generate-barcode' => 'generateBarcode',
        'updateConfirmed',
        'createConfirmed',
    ];
    public function updatedVatType($vat_type) //@params vat_type for enabling the vat amount
    {
        $this->vatType = $vat_type;

        if ($vat_type == 1) {
            $this->vat_amount_enabled = true;
        }
        if ($vat_type == 2) {   //* remove the value pag non vat
            $this->vat_amount = null;
        }
    }
    public function create() //* create process
    {

        $validated = $this->validateForm();

        $this->confirm('Do you want to add this item?', [
            'onConfirmed' => 'createConfirmed', //* call the createconfirmed method
            'inputAttributes' =>  $validated, //* pass the user to the confirmed method, as a form of array
        ]);
    }

    public function createConfirmed($data) //* confirmation process ng create
    {

        $validated = $data['inputAttributes'];

        $user = Item::create([
            'barcode' => $validated['barcode'],
            'item_name' => $validated['item_name'],
            'item_description' => $validated['item_description'],
            'maximum_stock_ratio' => $validated['maximum_stock_ratio'],
            'reorder_point' => $validated['reorder_point'],
            'vat_id' => $validated['vatType'],
            'vat_amount' => $validated['vat_amount'],
            'status_id' => $validated['status'],
        ]);


        $this->alert('success', 'Item was created successfully');
        $this->refreshTable();

        $this->resetForm();
        $this->closeModal();
    }

    public function update() //* update process
    {
        $validated = $this->validateForm();


        $items = Item::find($this->proxy_item_id); //? kunin lahat ng data ng may ari ng proxy_item_id

        //* ipasa ang laman ng validated inputs sa models
        $items->item_name = $validated['item_name'];
        $items->item_description = $validated['item_description'];
        $items->maximum_stock_ratio = $validated['maximum_stock_ratio'];
        $items->reorder_point = $validated['reorder_point'];
        $items->vat_id = $validated['vatType'];
        $items->vat_amount = $validated['vat_amount'];
        $items->status_id = $validated['status'];

        $attributes = $items->toArray();


        $this->confirm('Do you want to update this supplier?', [
            'onConfirmed' => 'updateConfirmed', //* call the confmired method
            'inputAttributes' =>  $attributes, //* pass the $attributes array to the confirmed method
        ]);
    }

    public function updateConfirmed($data) //* confirmation process ng update
    {


        //var sa loob ng $data array, may array pa ulit (inputAttributes), extract the inputAttributes then assign the array to a variable array
        $updatedAttributes = $data['inputAttributes'];

        //* hanapin id na attribute sa $updatedAttributes array
        $item = Item::find($updatedAttributes['id']);

        //* fill() method [key => value] means [paglalagyan => ilalagay]
        //* the fill() method automatically knows kung saan ilalagay ang elements as long as mag match ang mga keys, $item have same keys with $updatedAttributes array
        //var ipasa ang laman ng $updatedAttributes sa $item model
        $item->fill($updatedAttributes);

        $item->save(); //* Save the item model to the database

        $this->resetForm();
        $this->alert('success', 'items was updated successfully');

        $this->refreshTable();
        $this->closeModal();
    }

    public function generateBarcode()  //* generate a random barcode and contatinate the ITM
    {
        $numericCode = random_int(10000, 99999);
        $this->barcode = 'ITM-' . $numericCode;
    }

    public function resetFormWhenClosed()
    {
        $this->resetForm();
        $this->resetValidation();
    }
    public function edit($itemID)
    {
        $this->item_id = $itemID; //var assign ang parameter value sa global variable
        $this->proxy_item_id = $itemID;  //var proxy_item_id para sa update ng item kasi i null ang item id sa update afetr populating the form
    }

    private function resetForm() //*tanggalin ang laman ng input pati $item_id value
    {
        $this->reset(['item_id','item_description', 'item_name', 'barcode', 'reorder_point', 'vatType', 'vat_amount', 'status']);
        $this->vat_amount_enabled = false;
    }
    public function closeModal() //* close ang modal after confirmation
    {
        $this->dispatch('close-modal')->to(ItemManagementPage::class);
    }

    protected function validateForm()
    {
        $this->item_name = trim($this->item_name);

        $rules = [
             //? validation sa barcode paro iignore ang item_id para maupdate ang barcode kahit unique
            'barcode' => ['required', Rule::unique('items', 'barcode')->ignore($this->proxy_item_id)],
            'item_name' => 'required|string|max:255',
            'item_description' => 'required|string|max:255',
            'maximum_stock_ratio' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'reorder_point' => ['required', 'numeric'],
            'vatType' => 'required|in:1,2',
            'status' => 'required|in:1,2',
        ];

        if ($this->vatType == 1) {
            $rules['vat_amount'] = ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'];
        }

        return $this->validate($rules);
    }
    private function populateForm() //*lagyan ng laman ang mga input
    {

        $item_details = Item::find($this->item_id); //? kunin lahat ng data ng may ari ng item_id


        //* ipasa ang laman ng model sa inputs
        //* fill() method [key => value] means [paglalagyan => ilalagay]
        $this->fill([
            'barcode' => $item_details->barcode,
            'item_name' => $item_details->item_name,
            'item_description' => $item_details->item_description,
            'maximum_stock_ratio' => $item_details->maximum_stock_ratio,
            'reorder_point' => $item_details->reorder_point,
            'vatType' => $item_details->vat_id,
            'vat_amount' => $item_details->vat_amount,
            'status' => $item_details->status_id,

        ]);
    }
    public function refreshTable() //* refresh ang table after confirmation
    {
        $this->dispatch('refresh-table')->to(ItemTable::class);
    }
    public function changeMethod($isCreate)
    {
        $this->isCreate = $isCreate; //var assign ang parameter value sa global variable

        if ($this->isCreate) {

            $this->resetForm();
        }
    }
}