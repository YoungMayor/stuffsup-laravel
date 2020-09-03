<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileEdit\EditLocation;
use App\Http\Requests\ProfileEdit\EditContact;
use App\Http\Requests\ProfileEdit\EditPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileEditController extends Controller
{
    public function editAbout(Request $request, $token)
    {
        $user = User::find(Auth::id());
        if ($user->generateToken('edit about') == $token){
            $user->profile->about = $request->about;
            $user->profile->save();

            return response()->json([
                'msg' => "Your about me has been updated"
            ], 201);
        }else{
            return response()->json([
                'msg' => "You do not have authorization to perform this action"
            ], 403);
        }
    }

    public function editContact(EditContact $request, $token)
    {
        $user = User::find(Auth::id());
        if ($user->generateToken('edit contact') == $token){
            $name_changed = $email_changed = false;

            $user->profile->first_name = $request->first_name;
            $user->profile->last_name = $request->last_name;
            $user->profile->save();

            if ($request->has(['name', 'email', 'password'])){
                if (!Hash::check($request->password, $user->password)){
                    return response()->json([
                        'msg' => "Password incorrect"
                    ], 403);
                }

                if ($user->name !== $request->name){
                    $name_changed = true;
                    $user->name = $request->name;
                    $user->save();
                }

                if ($user->email !== $request->email){
                    $email_changed = true;
                    $user->email_verified_at = null;
                    $user->email = $request->email;
                    $user->save();
                }
            }

            return response()->json([
                'title' => "Your contact details has been updated",
                'msg' => $name_changed || $email_changed
                    ? "Changes would be reflected after reload!"
                    : "Your contact details have been changed successfully",
                'reload' => $email_changed || $name_changed
            ], 201);
        }else{
            return response()->json([
                'msg' => "You do not have authorization to perform this action"
            ], 403);
        }
    }

    public function editLocation(EditLocation $request, $token)
    {
        $user = User::find(Auth::id());
        if ($user->generateToken('edit location') == $token){
            $user->profile->state = $request->state;
            $user->profile->city = $request->city;
            $user->profile->address = $request->address;
            $user->profile->save();

            return response()->json([
                'msg' => "Your location details has been updated"
            ], 201);
        }else{
            return response()->json([
                'msg' => "You do not have authorization to perform this action"
            ], 403);
        }
    }

    public function editPassword(EditPassword $request, $token)
    {
        $user = User::find(Auth::id());
        if ($user->generateToken('edit password') == $token){
            if (!Hash::check($request->current_password, $user->password)){
                return response()->json([
                    'msg' => "Current Password Incorrect"
                ], 403);
            }

            if ($request->has('logout_others')){
                Auth::logoutOtherDevices($request->current_password);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            Auth::login($user);

            return response()->json([
                'msg' => "Password Changed. And all your logged in devices have been logged out",
                'reload' => true
            ], 201);
        }else{
            return response()->json([
                'msg' => "You do not have authorization to perform this action"
            ], 403);
        }
    }
}
