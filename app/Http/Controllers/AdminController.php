<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Newsletter;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $transactions = Order::orderBy('created_at', 'desc')->paginate(5);
        $users = User::where('role', '!=', 'admin')->get(); // Get the currently authenticated user
         // Get the count of registered users
         $userCount = User::where('role', '!=', 'admin')->count();
         $subscriberCount = Newsletter::count();

         $totalSales = Order::sum('total_price');
          // Get the total number of orders
        $totalOrders = Order::count();

        return view('admin.partial.body',compact('transactions','users','userCount','subscriberCount', 'totalSales','totalOrders'));
    }

    // Display all categories
    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    // Create a new category with image upload
    public function createCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $imageName); // Save the image in public/images/categories
            $validatedData['image'] = $imageName; // Save the image path
        }

        Category::create($validatedData);

        return back()->with('success', 'Category added successfully!');
    }

    // Edit a category
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.edit-category', compact('category'));
    }

    // Update a category with image upload
    public function updateCategory(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        $category = Category::findOrFail($id);

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($category->image && file_exists(public_path('images/categories/'.$category->image))) {
                unlink(public_path('images/categories/'.$category->image));
            }

            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $imageName); // Save the new image
            $validatedData['image'] = $imageName; // Save the image path
        }

        $category->update($validatedData);

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
    }

    public function showCategory($id)
    {
        // Fetch the category using the ID
        $category = Category::find($id);
        
        // Check if the category exists
        if (!$category) {
            return redirect()->route('admin.categories')->with('error', 'Category not found');
        }

        // Return a view with the category data
        return view('admin.show-category', compact('category'));
    }

    // Delete a category
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        // Delete the image if exists
        if ($category->image && file_exists(public_path('images/categories/'.$category->image))) {
            unlink(public_path('images/categories/'.$category->image));
        }

        $category->delete();
        return back()->with('success', 'Category deleted successfully!');
    }

    public function showProductsUnderCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();

        return view('admin.show-category-products', compact('category', 'products'));
    }



    
    public function transactionHistory()
    { // Load related order details and products
        $transactions = Order::with('orderDetails.product')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.transaction-history', compact('transactions'));
    }



    public function showOrders()
    {  
        
        $orders = Order::with(['orderDetails.product', 'user'])->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.orders', compact('orders'));

}


public function user(){
    $users=User::where('role', '!=', 'admin')->get();
    return view('admin.user',compact('users'));

}

public function subscriber(){

    $subscribers=Newsletter::all();
    return view('admin.subscriber',compact('subscribers'));
}

}