<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
	/**
	 * Handle an incoming authentication request.
	 */
	// public function store(LoginRequest $request): RedirectResponse
	// {
	//     $request->authenticate();

	//     $request->session()->regenerate();

	//     return redirect()->intended(RouteServiceProvider::HOME);
	// }

	// public function adminDashboard(){
	// 	return view('admin.dashboard');
	// }


	/**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully', 
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function adminProfileView(){
    	$id = auth()->id();
    	$profileData = User::find($id);
    	// $profileData = auth()->user();
    	// dd($profileData);
    	return view('admin.admin_profile_view', compact('profileData'));
    }

    public function adminProfileEdit(){
    	$profileData = auth()->user();
    	// dd($profileData);
    	return view('admin.admin_profile_edit', compact('profileData'));
    }

    public function adminProfileUpdate(Request $request){
    	// dd($request->all());
    	$profileData = auth()->user();

    	if($request->file('profile_image')){
    		if(file_exists($profileData->profile_image)){
    			unlink($profileData->profile_image);
    		}
    		$file = $request->file('profile_image');
    		$imageName = 'profile_image-'.time().'.'.$file->getClientOriginalExtension();
    		$directory = 'upload/profile_image/';
    		$file->move($directory, $imageName);
    		$imgPath['profile_image'] = $directory.$imageName;
    		// dd($imgPath);
    	}else{
    		$imgPath['profile_image'] = $profileData->profile_image;
    	}

    	$data = array_merge($request->all(), $imgPath);
    	// dd($data);
    	$profileData->update($data);

        $notification = [
            'message' => 'Profile upadeted successfully!!',
            'alert-type' => 'success'
        ];
    	return redirect()->back()->with($notification);
    }

    public function changePassword(){
        $userData = auth()->user();
        return view('admin.admin_change_password', compact('userData'));
    }

    public function updatePassword(Request $request){

        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $userData = auth()->user();
        $hashedPassword = $userData->password;
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $userData->password = Hash::make($request->password);
            $userData->save();

            session()->flash('message', 'Password updated successfully!!');
            return redirect()->back();
        }else{
            session()->flash('message', 'Old Password does nott match!!');
            return redirect()->back();
        }

    }


}
