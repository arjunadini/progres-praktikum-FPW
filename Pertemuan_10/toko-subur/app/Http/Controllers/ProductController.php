<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Jika tidak ada parameter ‘search’, langsung ambil produk dengan paginasi
        $products = Product::paginate(2);


      return view("master-data.product-master.index-product", compact('products'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("master-data\product-master\create-products");
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
    // validasi input data
    $validasi_data = $request->validate([
        'product_name' => 'required|string|max:255',
        'unit' => 'required|string|max:50',
        'type' => 'required|string|max:50',
        'information' => 'nullable|string',
        'qty' => 'required|integer',
        'producer' => 'required|string|max:255',
    ]);

    // Proses simpan data kedalam database
        Product::create($validasi_data);

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view("master-data.product-master.detail-product", compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('master-data.product-master.edit-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'information' => 'nullable|string',
            'qty' => 'required|integer|min:1',
            'producer' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($id);
        $product ->update([
            'product_name' => $request->product_name,
            'unit' => $request->unit,
            'type' => $request->type,
            'information' => $request->information,
            'qty' => $request->qty,
            'producer' => $request->producer,
        ]);

        return redirect()->back()->with('success', 'product update succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->route('product-index')->with('success', 'Product berhasil dihapus.');
        }
        return redirect()->route('product-index')->with('error', 'Product tidak ditemukan.');
    }
}
