<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Ulliminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function index(){
        $wallets = Auth::user()->wallets;
        return view('wallets.index', compact(\wallets));
    }

    public function store(Request request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:0',
        ]);

        Auth::user()->wallets()->create($request->all());

        return redirect()->back()->with('success', 'Wallet created successfully!');
    }
}
