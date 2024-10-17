<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // View the cart
    public function viewCart()
    {
       
        $cart = session()->get('cart', []);
        return view('frontend.cart.view', compact('cart'));
    }

    // Add product to cart
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        // Get the current cart from session, or initialize an empty array if no cart exists
        $cart = session()->get('cart', []);

        // If the product is already in the cart, update the quantity
        if(isset($cart[$id])) {
            if ($cart[$id]['quantity'] + 1 > $product->quantity) {
                return redirect()->back()->with('error', 'You cannot add more than the available quantity of this product!');
            }
            $cart[$id]['quantity']++;
        } else {
            // If the product is not in the cart, add it with quantity 1
            if ($product->quantity < 1) {
                return redirect()->back()->with('error', 'This product is out of stock!');
            }
            $cart[$id] = [
                "id"=>$product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        

        // Update the session with the new cart data
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    // Update cart quantities
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->id as $key => $id) {
            $product = Product::findOrFail($id);

            // Check if the updated quantity exceeds the available stock
            if ($request->quantity[$key] > $product->quantity) {
                return redirect()->back()->with('error', 'You cannot order more than the available stock for ' . $product->name);
            }

            // Update the quantity in the cart
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $request->quantity[$key];
            }
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    // Remove a product from the cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }
}

