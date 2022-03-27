<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    public function index(){
        $cart = Cart::where('user_id',Auth::id())->first();
        return view('users.cart.index')->with('cart',$cart);
    }

    // function dropDown(){
    //     $cart = Cart::where('user_id',Auth::id())->get();
    //     return view('partials.user-dropdown')->with('cart',$cart);
    // }
    public function store(Request $request){

        $this->validate($request,[
            'books'=>'required|array',
        ]);

        $user = Auth::user();
        $this->cartAttach($request,$user);
        return redirect()->route('cart.index');
    }

    public function updateItem(Request $request,Cart $cart){

        $this->validate($request,[
            'books'=>'required|array',
        ]);

        $oldqty = 0;
        $qty = 0;
        $bookId = 0;
        $totalPrice = 0;
        foreach($request->books as $id=>$quantity)
        {
            $book = Book::find($id);
            $totalPrice += $book->price * $quantity['quantity'];
            $qty = intval($quantity['quantity']);
            $bookId = $id;
        }

        foreach($cart->books as $item)
        {
            if($item->id == $book->id){$oldqty = $item->pivot->quantity;}
        }
        $cart->update([
            'total_price'=>($cart->total_price - ($book->price*$oldqty)) + $totalPrice,
        ]);

        $cart->books()->updateExistingPivot($bookId,array('quantity' => $qty));
        return redirect()->route('cart.index');
    }


    public function destroy(Book $book){
        $cart = Cart::where('user_id',Auth::id())->first();
        $qty=0;

        foreach($cart->books as $item){
            if($item->id == $book->id){$qty = $item->pivot->quantity;}
        }

        $cart->update([
            'total_price'=>$cart->total_price - ($book->price * $qty),
        ]);
        $cart->books()->detach($book->id);
        return redirect()->route('cart.index');
    }


    private function cartAttach($request,$user){
        if(is_null($user->cart))
        {
            $user->cart()->create([]);
        }
        $cart = Cart::where('user_id',Auth::id())->first();

        $totalPrice = 0;
        foreach($request->books as $id=>$quantity)
        {

            foreach($cart->books as $book)
            {
                if($book->id == $id)
                {
                    session()->flash('success', __('site.exist'));
                    return redirect()->route('cart.index');
                }
            }
            $book = Book::find($id);
            $totalPrice += $book->price * $quantity['quantity'];
        }

        $cart->books()->attach($request->books);
        $cart->update([
            'total_price'=> $cart->total_price + $totalPrice,
        ]);
    }
}
