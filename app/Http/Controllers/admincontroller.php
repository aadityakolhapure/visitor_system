<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Visitor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function createDepartment()
    {
        $departments = Department::all();
        return view('admin.addDepartment', compact('departments'));
    }

    public function showDepartments()
    {
        $departments = Department::orderBy('created_at', 'desc')->get();
        return view('admin.addDepartment', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:department,name',
        ]);

        Department::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Department added successfully.');
    }

    // show visitors
    public function showVisitors()
{
    $visitors = Visitor::orderBy('check_in', 'desc')->paginate();
    return view('admin.dashboard', compact('visitors'));
}

    // delete department
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->back()->with('success', 'Department deleted successfully.');
    }

}