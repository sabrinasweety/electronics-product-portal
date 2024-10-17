<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::pluck('name', 'id'); // Fetch categories from the database
        // Fetch other data as needed
        return view('frontend.master', compact('categories'));
    }




    public function home(){
        $categories = Category::all(); // Get all categories
        $products = Product::with('category')->get(); // Get all products with their categories
        $newProducts = Product::with('category')
             ->where('created_at', '>=', now()->subDays(30))
             ->get();

             $topSellingProducts = Product::with('category')

             ->join('order_details', 'products.id', '=', 'order_details.product_id')
     
             ->select('products.*', DB::raw('SUM(order_details.quantity) as total_sold'))
     
             ->groupBy('products.id')
     
             ->orderByDesc('total_sold')
     
             ->take(5) // Limit to top 5 best-selling products
     
             ->get();
     
     
         // Get top-selling products for each category
     
         $topSellingProductsByCategory = [];
     
         foreach ($categories as $category) {
     
             $topSellingProductsByCategory[$category->id] = Product::with('category')
     
                 ->where('category_id', $category->id)
     
                 ->join('order_details', 'products.id', '=', 'order_details.product_id')
     
                 ->select('products.*', DB::raw('SUM(order_details.quantity) as total_sold'))
     
                 ->groupBy('products.id')
     
                 ->orderByDesc('total_sold')
     
                 ->take(5) // Limit to top 5 best-selling products
     
                 ->get();
     
         }
     
     
         // Add top-selling products for all categories
     
         $allTopSellingProducts = Product::with('category')
     
             ->join('order_details', 'products.id', '=', 'order_details.product_id')
     
             ->select('products.*', DB::raw('SUM(order_details.quantity) as total_sold'))
     
             ->groupBy('products.id')
     
             ->orderByDesc('total_sold')
     
             ->take(10) // Limit to top 10 best-selling products across all categories
     
             ->get();
     
     
         return view('frontend.partial.body', compact('categories', 'products', 'newProducts', 'topSellingProducts', 'topSellingProductsByCategory', 'allTopSellingProducts'));
     
     
    }
     // Show products under a specific category
     public function showCategoryProducts($id)
     {
        $categories=Category::all();
         $category = Category::findOrFail($id); // Get the category by ID
         $products = Product::where('category_id', $id)->get(); // Get products under this category
         return view('frontend.category-products', compact('categories','category', 'products'));
     }
     public function newProducts()
     {
         // Fetch new products created in the last 30 days
         $newProducts = Product::with('category')
             ->where('created_at', '>=', now()->subDays(30))
             ->get();
 
         return view('frontend.new-products', compact('newProducts'));
     }

     public function show($id)
{

    $categories=Category::all();
    $product = Product::findOrFail($id); // Fetch the product by ID
    return view('frontend.product-view', compact('categories','product')); // Return the view with product details
}


public function search(Request $request)
{
    $searchTerm = $request->input('query');  // Renaming this to avoid conflict
    $categoryId = $request->input('category');

    // Query products based on the search criteria
    $products = Product::when($categoryId != 0, function($q) use ($categoryId) {
        return $q->where('category_id', $categoryId);
    })
    ->when($searchTerm, function($q) use ($searchTerm) {
        return $q->where('name', 'LIKE', "%{$searchTerm}%");
    })
    ->get();

    // Get all categories for the search form (if you need to show categories again)
    $categories = Category::all();

    return view('frontend.search', compact('products', 'categories'));
}




}
