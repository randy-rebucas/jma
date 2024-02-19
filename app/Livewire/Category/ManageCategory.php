<?php

namespace App\Livewire\Category;

use LivewireUI\Modal\ModalComponent;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class ManageCategory extends ModalComponent
{
    public $name = '';
    public $id;

    public $categories = [];

    protected $rules = [
        'name' => 'required|string|max:255'
    ];

    #[On('category-created')] 
    #[On('category-deleted')] 
    public function getCategories() {
        $this->categories = Category::all();
        $this->name = '';
    }

    public function mount()
    {
        $this->getCategories();
    }

    public function save()
    {
        $validated = $this->validate();

        $validated['slug'] = Str::slug($this->name);

        Category::create($validated);
 
        $this->dispatch('category-created');
    }

    public function delete($id): void
    {
        $category = Category::find($id);
        $category->delete();

        $this->dispatch('category-deleted');
    }

    public function render()
    {
        return view('livewire.category.manage-category');
    }
}
