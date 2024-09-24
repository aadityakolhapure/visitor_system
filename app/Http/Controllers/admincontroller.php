<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Visitor;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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

    public function visitorList()
    {
        $visitors = Visitor::orderBy('check_in', 'desc')->paginate();
        return view('admin.visitor', compact('visitors'));
    }

    // delete department
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->back()->with('success', 'Department deleted successfully.');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'unique_id' => 'required|string|size:10',
        ]);

        $visitor = Visitor::where('unique_id', $request->unique_id)
            ->whereNull('check_out')
            ->first();

        if (!$visitor) {
            return back()->with('error', 'No active visitor found with this ID.');
        }

        $visitor->check_out = Carbon::now()->setTimezone('Asia/Kolkata'); // Adjust the timezone as needed

        $visitor->save();

        return redirect()->route('admin.visitors')->with('success', 'Visitor checked out successfully.');
    }

    public function show($unique_id)
    {
        // Find the visitor by their unique ID
        $visitor = Visitor::where('unique_id', $unique_id)->firstOrFail();

        // Return the view with visitor details
        return view('admin.visitor_show', compact('visitor'));
    }

    public function destroyVisitors($id)
    {
        $visitor = Visitor::findOrFail($id);

        // Optionally, you can also delete the associated visitor photo from storage
        if ($visitor->photo) {
            Storage::delete('public/' . $visitor->photo);
        }

        // Delete the visitor
        $visitor->delete();

        // Redirect to the visitors list with a success message
        return redirect()->route('admin.visitors1')->with('success', 'Visitor deleted successfully.');
    }

    // csv file download
    public function exportCSV()
    {
        $visitors = Visitor::all(); // Or apply any filters you want

        $csvData = "Unique ID,Name,Phone,Check In,Check Out,Purpose,Meet\n";

        foreach ($visitors as $visitor) {
            $csvData .= "{$visitor->unique_id},{$visitor->name},{$visitor->phone},{$visitor->check_in},{$visitor->check_out},{$visitor->purpose},{$visitor->meet}\n";
        }

        $fileName = 'visitors_' . now()->format('Y-m-d_H-i-s') . '.csv';

        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
        ]);
    }

    public function index1(Request $request)
    {
        // Define the allowed filter keys
        $allowedFilters = ['search', 'date', 'month', 'year'];

        // Initialize $filters with default empty values
        $filters = array_fill_keys($allowedFilters, '');

        // Update $filters with actual request inputs
        foreach ($allowedFilters as $filter) {
            if ($request->has($filter)) {
                $filters[$filter] = $request->input($filter);
            }
        }

        $query = Visitor::query();

        // Apply search filter
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['search']}%")
                    ->orWhere('unique_id', 'like', "%{$filters['search']}%");
            });
        }

        // Apply date filter
        if (!empty($filters['date'])) {
            $query->whereDate('check_in', $filters['date']);
        }

        // Apply month filter
        if (!empty($filters['month'])) {
            $date = Carbon::createFromFormat('Y-m', $filters['month']);
            $query->whereYear('check_in', $date->year)
                ->whereMonth('check_in', $date->month);
        }

        // Apply year filter
        if (!empty($filters['year'])) {
            $query->whereYear('check_in', $filters['year']);
        }

        $visitors = $query->orderBy('check_in', 'desc')->paginate(10);

        // Append query string to pagination links
        $visitors->appends($filters);

        // Always pass $filters to the view
        return view('admin.visitor', compact('visitors', 'filters'));
    }

    // add users
    public function addUsers()
    {

        return view('admin.addusers');
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.addusers', compact('departments'));
    }

    public function store1(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'department_id' => 'required|exists:department,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department_id,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.create')->with('success', 'User added successfully.');
    }

    public function showUsers(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        $users = $query->with('department')->paginate(10);

        return view('admin.user_show', compact('users'));
    }

    public function showvisitors1(Request $request)
    {
        $query = Visitor::query();

        if ($request->has('searchs')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('phone', 'LIKE', "%{$searchTerm}%");
            });
        }

        // $users = $query->with('department')->paginate(10);

        return view('admin.visitor', compact('visitors'));
    }

    public function editUser(User $user)
    {
        $departments = Department::all();
        return view('admin.edit_user', compact('user', 'departments'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'department_id' => 'required|exists:department,id',
            // 'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department_id,
            // 'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }
}
