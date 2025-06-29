<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Item;
use App\Models\SaleItem;
use App\Models\StationaryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function create()
    {
        $categories = StationaryCategory::all();
        return view('sales.create', compact('categories'));
    }

    public function getProductsByCategory($categoryId)
    {
        $products = Item::where('category_id', $categoryId)
            ->select('item_id', 'name', 'price', 'image')
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->item_id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'image' => $item->image ? asset('storage/' . $item->image) : '/images/default-item.png'
                ];
            });

        return response()->json($products);
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'customer_name' => 'nullable|string|max:255',
        'discount' => 'nullable|numeric|min:0',
        'items' => 'required|array|min:1',
        'items.*.id' => 'required|exists:items,item_id',  // Changed to item_id
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.price' => 'required|numeric|min:0'
    ]);

    DB::beginTransaction();

    try {
        $subtotal = 0;
        $itemsToUpdate = [];

        // First pass to calculate subtotal and validate stock
        foreach ($validated['items'] as $itemData) {
            $item = Item::where('item_id', $itemData['id'])->firstOrFail();  // Changed to use item_id
            
            // Check stock availability
           

            $itemTotal = $itemData['price'] * $itemData['quantity'];
            $subtotal += $itemTotal;
            
            $itemsToUpdate[$item->item_id] = [  // Using item_id as key
                'quantity' => $item->quantity - $itemData['quantity']
            ];
        }

        // Calculate discount and grand total
        $discount = $validated['discount'] ?? 0;
        $grandTotal = $subtotal - $discount;

        // Create the sale
        $sale = Sale::create([
            'user_id' => auth()->id(),
            'customer_name' => $validated['customer_name'] ?? null,
            'total_amount' => $subtotal,
            'discount' => $discount,
            'grand_total' => $grandTotal,
            'sale_date' => now()
        ]);

        // Create sale items
        foreach ($validated['items'] as $itemData) {
            $sale->items()->create([
                'item_id' => $itemData['id'],  // This matches your SaleItem model
                'quantity' => $itemData['quantity'],
                'unit_price' => $itemData['price'],
                'total_price' => $itemData['price'] * $itemData['quantity']
            ]);
        }

        // Update inventory using item_id
        Item::whereIn('item_id', array_keys($itemsToUpdate))
            ->each(function ($item) use ($itemsToUpdate) {
                $item->update(['quantity' => $itemsToUpdate[$item->item_id]['quantity']]);
            });

        DB::commit();

        return response()->json([
            'success' => true,
            'redirect' => route('sales.receipt', $sale->id),
            'message' => 'Sale completed successfully!'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Sale Error: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Error completing sale: ' . $e->getMessage()
        ], 500);
    }
}

public function receipt(Sale $sale)
{
    // Find all items for this sale
    $saleItems = SaleItem::where('sale_id', $sale->id)
                ->with('item') // Eager load the related item
                ->get();
    
    // Alternative if you want to use the relationship
    $sale->load(['items.item']);
    
    return view('sales.receipt', [
        'sale' => $sale,
        'saleItems' => $saleItems // optional, you can use $sale->items instead
    ]);
}
}