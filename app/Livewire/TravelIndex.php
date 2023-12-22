<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Travel;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class TravelIndex extends Component
{
    use WithFileUploads;
    public $travels, $name, $description, $image, $price, $travel_id;
    public $isModalOpen = 0;
    public function render()
    {
        $this->travels = Travel::all();
        return view('livewire.travel')->layout('layouts.app');
    }
    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }
    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }
    private function resetCreateForm()
    {
        $this->name = '';
        $this->description = '';
        $this->image = '';
        $this->price = 0;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
        ]);

        $name = md5($this->image . microtime()) . '.' . $this->image->extension();
        $this->image->storeAs('public/image', $name);
        $this->image = "image/" . $name;

        Travel::updateOrCreate(['id' => $this->travel_id], [
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'price' => $this->price,
        ]);
        session()->flash('message', $this->travel_id ? 'Travel updated.' : 'Travel created.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }
    public function edit($id)
    {
        $travel = Travel::findOrFail($id);
        $this->travel_id = $id;
        $this->name = $travel->name;
        $this->email = $travel->email;
        $this->mobile = $travel->mobile;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        Travel::find($id)->delete();
        session()->flash('message', 'Travel deleted.');
    }
}
