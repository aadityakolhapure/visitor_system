<?php

namespace App\Http\Controllers;


use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Support\Carbon;

class VisitorController extends Controller
{
    public function create()
    {
        return view('visitors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
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
            'email' => $validated['email'],
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

        $visitor->check_out = Carbon::now();
        $visitor->save();

        return view('visitors.checkout-complete', compact('visitor'));
    }
}