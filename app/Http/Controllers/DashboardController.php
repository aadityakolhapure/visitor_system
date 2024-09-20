<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Carbon;

use function Laravel\Prompts\alert;

class DashboardController extends Controller
{
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

        return redirect()->route('dashboard')->with('success', 'Visitor checked out successfully.');
    }
    // public function index()
    // {
    //     // Limit the number of visitors fetched to 4
    //     $visitors = Visitor::orderBy('check_in', 'desc')->take(4)->get();
    
    //     // Pass the visitors to the view
    //     return view('dashboard', compact('visitors'));
    // }
    

}