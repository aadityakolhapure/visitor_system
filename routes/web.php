<?php
use App\Models\visitor;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\VisitorTable;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/visitor', [VisitorController::class, 'create'])->name('visitor.create');
Route::post('/visitor', [VisitorController::class, 'store'])->name('visitor.store');
Route::get('/visitor/preview/{id}', [VisitorController::class, 'preview'])->name('visitor.preview');
// Route::get('/visitor/download/{id}', [VisitorController::class, 'downloadPdf'])->name('visitor.download');
Route::get('/visitor/checkout', [VisitorController::class, 'checkoutForm'])->name('visitor.checkout.form');
Route::post('/visitor/checkout', [VisitorController::class, 'checkout'])->name('visitor.checkout');
Route::post('/dashboard/visitor/checkout', [DashboardController::class, 'checkout'])->name('visitors.checkout');
Route::get('/visitor/id-card/{id}', [VisitorController::class, 'downloadIdCard'])->name('visitor.id-card');
Route::get('/visitor/preview-form', [VisitorController::class, 'previewForm'])->name('visitor.preview.form');
Route::post('/visitor/preview', [VisitorController::class, 'previewById'])->name('visitor.preview.by.id');

Route::get('/dashboard/visitors/export', [VisitorController::class, 'exportCSV'])->name('visitors.export');
Route::get('/dashboard/visitor-graph', [VisitorController::class, 'visitorGraph'])->name('visitor.graph');


Route::get('/dashboard/visitors', [VisitorController::class, 'index'])->name('visitors');
Route::delete('/visitors/{id}', [VisitorController::class, 'destroy'])->name('visitor.destroy');
Route::delete('/dashboard', [VisitorController::class, 'homePage'])->name('home');




Route::get('/dashboard', function () {
    $visitors = Visitor::orderBy('check_in', 'desc')->take(5)->get();
    return view('dashboard', compact('visitors'));
})->middleware(['auth', 'verified'])->name('dashboard');

// routes/web.php
Route::get('/dashboard/visitors', [VisitorController::class, 'showVisitors'])->name('visitors');
// routes/web.php
Route::get('/dashboard/visitor/{unique_id}', [VisitorController::class, 'show'])->name('visitor.show');
Route::post('/dashboard/visitors/{id}/checkout', [VisitorController::class, 'checkout1'])->name('visitor.checkout1');
Route::post('/dashboard', [VisitorController::class, 'home'])->name('dash');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/visitors', VisitorTable::class)->name('visitors');
});

require __DIR__.'/auth.php';
