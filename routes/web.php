<?php
use App\Models\visitor;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\VisitorTable;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admincontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorController;
use App\Models\department;
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

Route::get('/visitors', [VisitorController::class, 'index'])->middleware('auth')->name('visitors');


// Route::get('/dashboard/visitors', [VisitorController::class, 'index'])->name('visitors');
Route::delete('/visitors/{id}', [VisitorController::class, 'destroy'])->name('visitor.destroy');
Route::delete('/dashboard', [VisitorController::class, 'homePage'])->name('home');

Route::get('/visitors', [VisitorController::class, 'index'])->name('visitors.index');


Route::get('/dashboard', function () {
    $visitors = Visitor::orderBy('check_in', 'desc')->take(5)->get();
    return view('dashboard', compact('visitors'));
})->middleware(['auth', 'verified'])->name('dashboard');

// routes/web.php
Route::get('/dashboard/visitors', [VisitorController::class, 'showVisitors'])->name('visitors');
// routes/web.php
Route::get('/dashboard/visitor/{unique_id}', [VisitorController::class, 'show'])->middleware('auth')->name('visitor.show');
Route::post('/dashboard/visitors/{id}/checkout', [VisitorController::class, 'checkout1'])->name('visitor.checkout1');
Route::post('/dashboard', [VisitorController::class, 'home'])->name('dash');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/visitors', VisitorTable::class)->name('visitors');
});

// Admin routes
Route::get('/admin/dashboard', [admincontroller::class, 'index'])->middleware(['auth', 'verified'])->name('admin.dashboard');


Route::get('/admin/addDepartment', [admincontroller::class, 'createDepartment'])->name('departments');
Route::get('/admin/departments', [AdminController::class, 'showDepartments'])->name('admin.departments');
Route::get('/admin/dashboard', [AdminController::class, 'showVisitors'])->name('admin.visitors');
Route::post('/admin/departments', [AdminController::class, 'store'])->name('admin.departments.store');
Route::delete('/admin/departments/{id}', [AdminController::class, 'destroy'])->name('admin.departments.destroy');

Route::get('/admin/visitors',[AdminController::class, 'visitorList'])->name('admin.visitors1');
Route::get('/admin/visitor/{unique_id}',[AdminController::class, 'show'])->name('admin.visitor.show');
Route::delete('/admin/visitors/{id}', [admincontroller::class, 'destroyVisitors'])->name('admin.visitor.destroy');
Route::post('/admin/visitor/checkout', [admincontroller::class, 'checkout'])->name('admin.visitors.checkout');
Route::get('/admin/visitors/export', [admincontroller::class, 'exportCSV'])->name('admin.visitors.export');
// Route::get('/admin/visitors/', [admincontroller::class, 'index1'])->name('admin.visitors.from.details');

// add user route
// Route::get('/admin/addusers', [admincontroller::class, 'addUsers'])->name('admin.addusers');
// Route::get('/admin/create', [admincontroller::class, 'create'])->name('users.create');
// Route::post('/users', [admincontroller::class, 'store1'])->name('users.store');
Route::get('/admin/users/create', [AdminController::class, 'create'])->name('users.create');
Route::post('/admin/users', [AdminController::class, 'store1'])->name('users.store');
Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::put('/admin/users/', [AdminController::class, 'showvisitorslist'])->name('admin.show.visitors');
Route::get('/admin/visitor-stats', [AdminController::class, 'getVisitorStats'])->name('admin.visitor-stats');
Route::get('/admin/visitor-graph', [admincontroller::class, 'visitorGraph'])->name('admin.visitor.graph');
Route::get('/admin/quick-stats', [AdminController::class, 'getQuickStats'])->name('admin.quick-stats');
Route::get('/api/users-by-department/{department}', [VisitorController::class, 'getUsersByDepartment']);
Route::get('/api/users-by-department/{departmentId?}', [VisitorController::class, 'getUsersByDepartment']);
Route::get('/admin/visitor-graph/{year}/{month}', [AdminController::class, 'getMonthData']);
Route::get('/admin/visitor-graph/{year}/{month}/{day}', [AdminController::class, 'getDayData']);
Route::post('/admin/users/bulk-upload', [admincontroller::class, 'bulkUpload'])->name('users.bulk-upload');
Route::get('/admin/import', [UserController::class, 'importForm'])->name('import.form');
Route::post('/admin/import', [UserController::class, 'import'])->name('import');

require __DIR__.'/auth.php';
