<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Cart;
use App\Models\User;



class OrderController extends Controller
{


    public function index(){
        $orders = Order::where('user_id',Auth::id())->get();
        return view('orders.index')->with('orders',$orders);
    }

    public function create(){
        $cart = Cart::where('user_id',Auth::id())->first();
        return view('orders.create')->with('cart',$cart);

    }

    public function store(Request $request){
        $this->validate($request,[
            'books'=>'required|array',
        ]);
        $user = Auth::user();
        $cart = Cart::where('user_id',Auth::id())->first();
        $this->orderAttach($request,$user);


        return redirect()->route('orders.create');
    }

    public function destroy(Order $order){
        foreach($order->books as $book){
            $book->update([
                'stock'=> $book->stock + $book->pivot->quantity
            ]);
        }

        $order->delete($order->id);
        return redirect()->route('order.index');
    }

    public function thankyou(){
        return view('orders.thankyou');
    }
    private function orderAttach($request,$user){
        $order = $user->orders()->create([]);
        $order->books()->attach($request->books);
        $totalPrice = 0;
        foreach($request->books as $id=>$quantity)
        {
            $book = Book::find($id);
            $user->books()->attach($book->id);
            $totalPrice += $book->price * $quantity['quantity'];

            $book->update([
                'stock' =>$book->stock - $quantity['quantity'],
            ]);

        }
        $order->update([
            'total_price'=>$totalPrice,
        ]);

    }
}
