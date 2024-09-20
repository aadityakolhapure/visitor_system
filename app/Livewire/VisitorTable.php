<?php
namespace App\Http\Livewire;

use App\Models\Visitor;

use Livewire\Component;

class VisitorTable extends Component
{
    public $visitors;
    public function index()
    {
        $visitors = Visitor::orderBy('check_in', 'desc')->get('4');
        return view('dashboard', compact('visitors'));
    }

    public function render()
    {
        $this->visitors = Visitor::all(); // Assuming you have a Visitor model

        return view('livewire.visitor-table');
    }
}
