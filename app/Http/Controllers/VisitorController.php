<?php

namespace App\Http\Controllers;


use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class VisitorController extends Controller
{
    public $filters;
    public function create()
    {
        return view('visitors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'meet' => 'required|string|max:255',
            'purpose' => 'required|string|max:1000',
            'photo' => 'required|string',
        ]);

        $uniqueId = $this->generateUniqueId();

        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $validated['photo']));
        $filename = 'visitor_' . $uniqueId . '_' . time() . '.jpg';
        Storage::disk('public')->put('visitor_photos/' . $filename, $image);

        $visitor = Visitor::create([
            'unique_id' => $uniqueId,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'meet' => $validated['meet'],
            'purpose' => $validated['purpose'],
            'photo' => 'visitor_photos/' . $filename,
        ]);

        return redirect()->route('visitor.preview', $visitor->id);
    }

    public function preview($id)
    {
        $visitor = Visitor::findOrFail($id);
        return view('visitors.preview', compact('visitor'));
    }

    // app/Http/Controllers/VisitorController.php
    public function showVisitors()
    {
        // Fetch and paginate visitors
        $visitors = Visitor::orderBy('check_in', 'desc')->paginate();

        // Return the visitors_table view with paginated visitors
        return view('visitor_table', compact('visitors'));
    }

    public function show($unique_id)
    {
        // Find the visitor by their unique ID
        $visitor = Visitor::where('unique_id', $unique_id)->firstOrFail();

        // Return the view with visitor details
        return view('visitor_show', compact('visitor'));
    }

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

    public function checkout1($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->check_out = now(); // Set the current time as check-out time
        $visitor->save();

        return redirect()->route('visitors')->with('success', 'Visitor checked out successfully.');
    }

    public function home()
    {
        return view('dashboard');
    }


    public function downloadPdf($id)
    {
        $visitor = Visitor::findOrFail($id);
        $pdf = PDF::loadView('visitors.pdf', compact('visitor'));
        return $pdf->download('visitor_' . $visitor->unique_id . '.pdf');
    }

    private function generateUniqueId()
    {
        do {
            $uniqueId = Str::random(10);
        } while (Visitor::where('unique_id', $uniqueId)->exists());

        return $uniqueId;
    }

    public function checkoutForm()
    {
        return view('visitors.checkout');
    }

    public function homePage(){
        return view('dashboard');
    }
    public function downloadIdCard($id)
    {
        $visitor = Visitor::findOrFail($id);
        $pdf = PDF::loadView('visitors.id-card', compact('visitor'));

        // Set paper size to ID card dimensions (3.375 x 2.125 inches)
        $pdf->setPaper([0, 0, 400, 300], 'landscape');

        return $pdf->download('visitor_id_' . $visitor->unique_id . '.pdf');
    }

    public function previewForm()
    {
        return view('visitors.preview-form');
    }

    public function previewById(Request $request)
    {
        $request->validate([
            'unique_id' => 'required|string|size:10',
        ]);

        $visitor = Visitor::where('unique_id', $request->unique_id)->first();

        if (!$visitor) {
            return back()->with('error', 'No visitor found with this ID.');
        }

        return view('visitors.preview', compact('visitor'));
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

        return view('visitors.checkout-complete', compact('visitor'));
    }

    public function index(Request $request)
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
        return view('visitors_table', compact('visitors', 'filters'));
    }

    public function destroy($id)
    {
        $visitor = Visitor::findOrFail($id);

        // Optionally, you can also delete the associated visitor photo from storage
        if ($visitor->photo) {
            Storage::delete('public/' . $visitor->photo);
        }

        // Delete the visitor
        $visitor->delete();

        // Redirect to the visitors list with a success message
        return redirect()->route('visitors')->with('success', 'Visitor deleted successfully.');
    }


    public function visitorGraph(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);

        // Get visitor counts for the selected year
        $visitorCounts = Visitor::select(
            DB::raw('DATE_FORMAT(check_in, "%Y-%m") as month'),
            DB::raw('COUNT(*) as count')
        )
            ->whereYear('check_in', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Prepare data for the chart
        $labels = [];
        $data = [];
        $startDate = Carbon::create($year, 1, 1);

        for ($month = 1; $month <= 12; $month++) {
            $monthKey = $startDate->copy()->month($month)->format('Y-m');
            $count = $visitorCounts->where('month', $monthKey)->first()->count ?? 0;

            $labels[] = $startDate->copy()->month($month)->format('M');
            $data[] = $count;
        }

        // Get list of years for the dropdown
        $years = Visitor::selectRaw('YEAR(check_in) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('visitor_graph', compact('labels', 'data', 'years', 'year'));
    }
}
