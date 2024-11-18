<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Support\Facades\File;


class productController extends Controller
{
    public function index()
{
    // Use the correct column name 'created_at'
    $products = Product::orderBy('created_at', 'DESC')->get();
    return view('products.list', ['products' => $products]);
}
    public function create(){
        return view('products.create');
        
    }
    public function store(Request $request){
        $rules = [
            'name' => 'required|string|min:5',
            // 'sku' => 'required|min:3',
            'price' => 'required|numeric',
            // 'description' => 'required|string',
            // 'image' => 'required|string',
        ];
        if ($request->image != "") {
            $rules['image'] = 'image';
        }
       $validator= validator::make($request->all() , $rules);
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }
    
        // Store the validated data in the Product model
        $product = new Product();
        $product->name = $request->input('name');
        // $product->sku = $request->input('sku');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        // $product->image = $request->input('image');
        $product->save();
    // Redirect or return a response

    if ($request->image != "") {
        $image = $request->image;
    $ext = $image->getClientOriginalExtension();
    $imageName = time(). '.'.$ext;
    $image->move(public_path('Uploads/Products'), $imageName);
    $product->image = $imageName;
    $product->save();
    }
   

    return redirect()->route('products.index')->with('success', 'Products add successfully!');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Fetch the product or throw a 404 if not found
        return view('products.edit', compact('product')); // Pass the product to the view
    }
    
    public function update($id, Request $request)
{
    // Fetch the product or throw a 404 if not found
    $product = Product::findOrFail($id);

    // Define validation rules
    $rules = [
        'name' => 'required|string|min:5',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image rules are optional
    ];

    // Validate the request
    $validator = Validator::make($request->all(), $rules);

    // Check if validation fails
    if ($validator->fails()) {
        return redirect()->route('products.edit', $id)
            ->withInput()
            ->withErrors($validator);
    }

    // Update product fields
    $product->name = $request->input('name');
    $product->price = $request->input('price');
    $product->description = $request->input('description'); // Assuming this is required

    // Handle image upload and deletion of old image
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($product->image && file_exists(public_path('Uploads/Products/' . $product->image))) {
            File::delete(public_path('Uploads/Products/' . $product->image));
        }

        // Save the new image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('Uploads/Products'), $imageName);
        $product->image = $imageName;
    }

    // Save the updated product
    $product->save();

    // Redirect with success message
    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}

    public function delete($id){
        $product = Product::findOrFail($id); 
        File::delete(public_path('Uploads/Products/' . $product->image));
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted successfully!');
    }
}
