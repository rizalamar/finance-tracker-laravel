<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function index(){
        $wallets = Auth::user()->wallets;
        return view('wallets.index', compact('wallets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:0',
        ]);

        Auth::user()->wallets()->create($request->all());

        return redirect()->back()->with('success', 'Wallet created successfully!');
    }

    public function edit(Wallet $wallet)
    {
        $this->authorize('update', $wallet);
        return view('wallets.edit', compact('wallet'));
    }

    public function update(Request $request, Wallet $wallet)
    {
        $this->authorize('update', $wallet);

        $request->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:0',
        ]);

        $wallet->update($request->all());

        return redirect()->route('wallets.index')->with('success', 'Wallet updated successfully!');
    }

    public function destroy(Wallet $wallet)
    {
        $this->authorize('delete', $wallet);
        $wallet->delete();

        return redirect()->back()->with('success', 'Wallet deleted successfully!');
    }
    }
