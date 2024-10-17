<?php

namespace App\Http\Controllers;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\OrderDetails;
use Illuminate\Support\Str;

    use App\Models\Order;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
     
        $cart = session()->get('cart',[]);
        return view('frontend.checkout',compact('cart'));
    }

// public function placeOrder(Request $request)
// {
//     // Validate the request here for address, phone, etc.
//     $validatedData = $request->validate([
//         'address' => 'required|string',
//         'phone_number' => 'required|string',
//         'name' => 'required|string',
//         'email_address' => 'required|email',
//     ]);

//     // Get the cart from the session
//     $cart = session()->get('cart');

//     // Check if the cart is null or empty
//     if (!$cart || empty($cart)) {
//         return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
//     }

//     // Calculate total price dynamically
//     $totalPrice = array_sum(array_map(function($item) {
//         return $item['price'] * $item['quantity'];
//     }, $cart));

//     // Create the order
//     $order = Order::create([
//         'user_id' => auth()->user()->id,
//         'status' => 'pending',
//         'total_price' => $totalPrice, // Use the calculated total price here
//         'address' => $validatedData['address'],
//         'receiver_mobile' => $validatedData['phone_number'],
//         'receiver_name' => $validatedData['name'],
//         'receiver_email' => $validatedData['email_address'],
//         'transaction_id' => date('YmdHis'), // Unique transaction ID
//     ]);

//     // Create order details
//     foreach ($cart as $item) {
//         OrderDetails::create([
//             'order_id' => $order->id,
//             'product_id' => $item['id'],
//             'quantity' => $item['quantity'],
//             // Calculate subtotal dynamically here
//             'subtotal' => $item['price'] * $item['quantity'], // Subtotal for each item
//         ]);
//     }

//     // Forget the cart session
//     session()->forget('cart');

//     // Initiate the payment process
//     $this->payment($order);

//     // Redirect to payment page or confirmation
//     return redirect()->route('payment.success', ['order_id' => $order->id]);
// }



public function placeOrder(Request $request)
{
    // Validate the request here for address, phone, etc.
    $validatedData = $request->validate([
        'address' => 'required|string',
        'phone_number' => 'required|string',
        'name' => 'required|string',
        'email_address' => 'required|email',
    ]);

    // Get the cart from the session
    $cart = session()->get('cart');

    // Check if the cart is null or empty
    if (!$cart || empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
    }

    // Calculate total price dynamically
    $totalPrice = array_sum(array_map(function($item) {
        return $item['price'] * $item['quantity'];
    }, $cart));

    // Create the order
    $order = Order::create([
        'user_id' => auth()->user()->id,
        'status' => 'pending',
        'total_price' => $totalPrice, // Use the calculated total price here
        'address' => $validatedData['address'],
        'receiver_mobile' => $validatedData['phone_number'],
        'receiver_name' => $validatedData['name'],
        'receiver_email' => $validatedData['email_address'],
        'transaction_id' => date('YmdHis'), // Unique transaction ID
    ]);

    // Loop through the cart and create order details + update product stock
    foreach ($cart as $item) {
        // Reduce product stock based on order quantity
        $product = \App\Models\Product::find($item['id']);
        if ($product) {
            if ($product->quantity >= $item['quantity']) {
                $product->quantity -= $item['quantity'];
                $product->save(); // Save the updated quantity
            } else {
                return redirect()->back()->with('error', 'Not enough stock for ' . $product->name);
            }
        }

        // Create order details
        OrderDetails::create([
            'order_id' => $order->id,
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            // Calculate subtotal dynamically here
            'subtotal' => $item['price'] * $item['quantity'], // Subtotal for each item
        ]);
    }

    // Forget the cart session
   session()->forget('cart');

    // Initiate the payment process
    $this->payment($order);

    // Redirect to payment page or confirmation
    return redirect()->route('transaction', ['order_id' => $order->id]);
}



public function payment($newOrder)
{
    $post_data = array();
    $post_data['total_amount'] = $newOrder->total_price;
    $post_data['currency'] = "BDT";
    $post_data['tran_id'] = $newOrder->transaction_id; // Ensure unique transaction ID
    
    # CUSTOMER INFORMATION
    $post_data['cus_name'] = $newOrder->receiver_name;
    $post_data['cus_email'] = $newOrder->receiver_email;
    $post_data['cus_add1'] = $newOrder->address;
    $post_data['cus_city'] = "Dhaka";
    $post_data['cus_country'] = "Bangladesh";
    $post_data['cus_phone'] = $newOrder->receiver_mobile;

    # SHIPMENT INFORMATION
    $post_data['ship_name'] = "E-Commerce Store";
    $post_data['ship_add1'] = $newOrder->address;
    $post_data['ship_city'] = "Dhaka";
    $post_data['ship_country'] = "Bangladesh";

    # PRODUCT INFORMATION
    $post_data['shipping_method'] = "NO";
    $post_data['product_name'] = "Product Purchase";
    $post_data['product_category'] = 'Goods'; // Make sure this is set properly
    $post_data['product_profile'] = "physical-goods"; 

    # Optional Parameters
    $post_data['value_a'] = "ref001";
    $post_data['value_b'] = "ref002";
    
    # SSLCommerz payment initiation
    $sslc = new SslCommerzNotification();
    $payment_options = $sslc->makePayment($post_data, 'hosted');

    if (!is_array($payment_options)) {
        print_r($payment_options);
        $payment_options = array();
    }
}

}