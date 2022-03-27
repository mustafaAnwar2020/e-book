<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(){
        $users = User::all();
        return view('users.index')->with('users',$users);

    }

    public function create(){
        $role=Role::all();
        return view('users.create')->with('role',$role);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>"required|string",
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'contact' => 'required|url',
            'password' =>'required|string|min:8',
            'role'=>'required'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
        ]);

        $profile = Profile::create([
            'user_id'=>$user->id,
            'address' =>$request->address,
            'phone'=>$request->phone,
            'contact'=>$request->contact
        ]);
        $user->assignRole($request->role);
        return redirect()->route('users.index');
    }

    public function edit(User $user){
        $role=Role::all();
        $userRole = DB::table('model_has_roles')->where('model_id',$user->id)->pluck('role_id','role_id')->first();
        return view('users.edit')->with('user',$user)->with('role',$role)->with('userRole',$userRole);
    }

    public function update(Request $request, User $user){
        $this->validate($request,[
            'name' =>"required|string",
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'contact' => 'required|url',
            'role' =>'required'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->profile->phone = $request->phone;
        $user->profile->address = $request->address;
        $user->profile->contact = $request->contact;
        $user->profile->save();
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->assignRole($request->role);
        return redirect()->route('users.index');
    }

    public function destroy(User $user){
        $user->delete($user->id);
        return redirect()->route('users.index');
    }


    public function addFavourite(Book $book){
        $user = User::where('id',Auth::id())->first();
        $favBook = DB::table('user_books')->where('user_books.book_id',$book->id)->first();
        if(is_null($favBook)){
            $user->books()->attach($book->id);
        }
        $user->books()->updateExistingPivot($book->id,array('favourite' => true));
        return redirect()->route('home.index');
    }

    public function deleteFavourite(Book $book){
        $user = User::where('id',Auth::id())->first();
        $favBook = DB::table('user_books')->where('user_books.book_id',$book->id)->first();
        $user->books()->updateExistingPivot($book->id,array('favourite' => false));
        return redirect()->route('profile.index');
    }
}
