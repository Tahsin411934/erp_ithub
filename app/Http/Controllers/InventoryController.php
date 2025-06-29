<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Item;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
         $items = Item::all();
        $inventory = Inventory::with('item')->latest()->get();
        return view('inventory.index', compact('inventory','items'));
    }

    public function create()
    {
        $items = Item::all();
        return view('inventory.create', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,item_id',
            'quantity' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:100',
            'expiry_date' => 'nullable|date',
            'supplier' => 'nullable|string|max:100'
        ]);

        Inventory::create($validated);

        return redirect()->route('inventory.index')
                        ->with('success', 'Inventory record created successfully.');
    }

    public function show(Inventory $inventory)
    {
        return view('inventory.show', compact('inventory'));
    }

    public function edit(Inventory $inventory)
    {
        $items = Item::all();
        return view('inventory.edit', compact('inventory', 'items'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,item_id',
            'quantity' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:100',
            'expiry_date' => 'nullable|date',
            'supplier' => 'nullable|string|max:100'
        ]);

        $inventory->update($validated);

        return redirect()->route('inventory.index')
                        ->with('success', 'Inventory record updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventory.index')
                        ->with('success', 'Inventory record deleted successfully.');
    }
}