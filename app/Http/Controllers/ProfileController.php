<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        $id = Auth::id();

        if($user->profile == null){
            $profile = Profile::create([
                "user_id" => $id,
                "address" => "test address",
                "phone" =>"+5691011642",
                "contact" => "https://facebook.com/"
            ]);
        }

        return view('users.profile.index')->with('user',$user);
    }

    public function edit(Profile $profile){
        return view('users.profile.edit')->with('profile',$profile);
    }

    public function update(Request $request, Profile $profile)
    {
        $this->validate($request,[
            'name' =>'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'contact' => 'required|url'
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();
        $user->profile->address = $request->address;
        $user->profile->phone = $request->phone;
        $user->profile->contact = $request->contact;
        $user->profile->save();
        return redirect()->route('profile.index');
    }


    public function changePassword(Request $request){
        $this->validate($request,[
            'oldPassword'=>'required|min:8|string',
            'newPassword' =>'required|min:8|string',
            'confirmPassword' =>'required|min:8|string|same:newPassword'
        ]);
        $user = Auth::user();

        $check=Hash::check($request->oldPassword,$user->password);
        // dd($check);
        if($check){
            $user->password = Hash::make($request->newPassword);
            $user->save();
        }
        return redirect()->route('profile.index');
    }

    public function favouriteBooks(User $user){
        $user->load(['books' => function ($query) {
            $query->where('favourite', true)->with('authors');
        }]);
        return view('users.profile.favourite')->with('user',$user);
    }

}
