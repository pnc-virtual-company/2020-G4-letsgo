<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->gender = $request->sex;
        $user->age = $request->age;
        $user->email = $request->email;
        if ($request->hasfile('profile')) {
            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('image/', $filename);
            $user->profile = $filename;
        }
        $user->save();
        return redirect('/home');
    }
    /**
     * delete user profile
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProfile($id)
    {
        $user = User::find($id);
        $user->profile = "user.png";
        $user->save();
        return redirect('/home');
    }
    /**
     * change new password
     *  @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $user = User::find(Auth::id());
        if ($request->newPassword == $request->comfirmPassword) {
            $user->password = Hash::make($request['newPassword']);;

            $user->save();
        }
        return back();
    }
}
