<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Visitor;

class VisitorTable extends Component
{
    use WithPagination;

    public function render()
    {
        // Fetch paginated visitors, 10 per page
        $visitors = Visitor::paginate(10);

        return view('livewire.visitor-table', ['visitors' => $visitors]);
    }
}
