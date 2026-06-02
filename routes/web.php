<?php

    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\WalletController;
    use App\Http\Controllers\TransactionController;
    use Illuminate\Support\Facades\Route;
    use App\Models\Transaction;
    use Illuminate\Support\Facades\Auth;

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        $totalBalance = Auth::user()->wallets()->sum('balance');
        $totalExpense = Transaction::whereHas('wallet', function($query) {
            $query->where('user_id', Auth::id());
        })->where('type', 'expense')->sum('amount');

        $recentTransactions = Transaction::whereHas('wallet', function($query) {
            $query->where('user_id', Auth::id());
        })->with('wallet')->latest()->take(5)->get();

        return view('dashboard', compact('totalBalance', 'totalExpense', 'recentTransactions'));
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware(['auth'])->group(function() {
        Route::resource('wallets', WalletController::class);
        Route::resource('transactions', TransactionController::class);
    });
require __DIR__.'/auth.php';
