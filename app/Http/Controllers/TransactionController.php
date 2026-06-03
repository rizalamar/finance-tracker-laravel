<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(){
        //get all transaction from user's wallet
        $transactions = Transaction::whereHas('wallet', function($query) {
            $query->where('user_id', Auth::id());
        })->with('wallet')->latest()->get();

        //get walet list
        $wallets = Auth::user()->wallets;

        return view('transactions.index', compact('transactions', 'wallets'));
    }

    public function store(Request $request){
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'transaction_date' => 'required|date',
        ]);
        
        //Atomicity like
        DB::transaction(function() use ($request) {
            $transaction = Transaction::create($request->all());
            $wallet = Wallet::find($request->wallet_id);
            if($request->type === 'income'){
                $wallet->increment('balance', $request->amount);
            } else {
                $wallet->decrement('balance', $request->amount);
            }
        });

        return redirect()->back()->with('success', 'Transaction recorded!');
    }

    public function destroy(Transaction $transaction)
    {
        // Ensure user owns the wallet of this transaction
        if ($transaction->wallet->user_id !== Auth::id()) {
            abort(403);
        }

        DB::transaction(function() use ($transaction) {
            $wallet = $transaction->wallet;

            // Reverse the balance effect
            if ($transaction->type === 'income') {
                $wallet->decrement('balance', $transaction->amount);
            } else {
                $wallet->increment('balance', $transaction->amount);
            }

            $transaction->delete();
        });

        return redirect()->back()->with('success', 'Transaction deleted and balance adjusted!');
    }
}
