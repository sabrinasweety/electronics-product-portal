<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

class ProductController extends Controller

{
    // Display all products
    public function products()
    {
        $products = Product::with('category')->get();
        return view('admin.products.view', compact('products'));
    }


    // Show form to create a product
    public function createProductForm()
    {
        $categories = Category::all(); // Get all categories for the dropdown
        return view('admin.products.create-product', compact('categories'));
    }

    // Create a new product
    public function createProduct(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Save image in the public folder
            $validatedData['image'] = $imageName; // Store the image path in the database
        }

        Product::create($validatedData);

        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    public function editProduct($id)
{
    $product = Product::findOrFail($id);
    $categories = Category::all(); // Get all categories for the dropdown
    return view('admin.products.edit-product', compact('product', 'categories'));
}
    // Update a product
    public function updateProduct(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                unlink(public_path('images/'.$product->image));
            }

            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        $product->update($validatedData);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }
// Show a specific product
public function showProduct($id)
{
    // Find the product by ID
    $product = Product::with('category')->findOrFail($id);
    
    // Return the view with the product data
    return view('admin.products.show-product', compact('product'));
}

    // Delete a product
    public function deleteProduct($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Product deleted successfully!');
    }


    
}


