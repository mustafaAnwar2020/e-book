<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;

class OrderController extends Controller
{


    public function index(){
        $orders = Order::all();
        return view('orders.index')->with('orders',$orders);
    }


    public function store(Request $request){
        $this->validate($request,[
            'books'=>'required|array',
        ]);
        $user = Auth::user();
        $this->orderAttach($request,$user);
        return redirect()->route('home.index');
    }

    public function cart(){
        $userId = Auth::id();
        $order = Order::where('user_id',$userId)->latest()->first();
        return view('orders.cart')->with('order',$order);
    }

    public function update(Request $request,User $user,Order $order)
    {
        $this->validate($request,[
            'books'=>'required|array',
        ]);

        $this->orderDetach($order);

        $this->orderAttach($request,$user);

        return redirect()->route('order.cart');
    }


    public function destroy($order){
        dd($order);
        foreach($order->books as $book){
            $book->update([
                'stock'=> $book->stock + $book->pivot->quantity
            ]);
        }

        $order->delete($order->id);
        return redirect()->route('order.cart');
    }


    private function orderAttach($request,$user){
        $order = $user->orders()->create([]);
        $order->books()->attach($request->books);
        $totalPrice = 0;
        foreach($request->books as $id=>$quantity)
        {
            $book = Book::find($id);
            $totalPrice += $book->price * $quantity['quantity'];

            $book->update([
                'stock' =>$book->stock - $quantity['quantity'],
            ]);

            $order->update([
                'total_price'=>$totalPrice,
            ]);
        }
    }

    private function orderDetach($order){
        foreach($order->books as $book){

            $book->update([
                'stock'=> $book->stock + $book->pivot->quantity
            ]);
        }

        $order->delete($order->id);
    }
}
