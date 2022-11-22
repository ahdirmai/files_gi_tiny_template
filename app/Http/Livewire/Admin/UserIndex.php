<?php

namespace App\Http\Livewire\Admin;

use App\Models\Division;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;
    public $search;
    public $divisi;

    protected $queryString = [
        'search', 'divisi'
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
        $this->divisi = request()->query('divisi', $this->divisi);
    }

    public function render()
    {
        $data = [
            'users' => $this->search === null && $this->divisi === null ?
                User::latest()->paginate($this->paginate) :
                User::latest()->where('name', 'like', '%' . $this->search . '%')
                ->where('division_id', $this->divisi)
                ->paginate($this->paginate),
            'divisions' => Division::all()
        ];
        return view('livewire.admin.user-index', $data);
    }
}
