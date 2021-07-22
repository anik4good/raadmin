<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Profile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {

        $profile = Profile::with('user')->where('user_id',Auth::id())->first();

        //  return $profile->user->get_roles_single();

        return view('backend.profile', compact('profile'));
    }




    public function store(Request $request)
    {
        return $request;


    }


    public function update(Request $request)
    {
        // update role
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'avatar' => 'nullable|image',
            'post_code' => 'numeric'
        ]);

        if ($validator->fails()) {
            // return with error msg
            notify()->error($validator->messages()->first(), 'Error');
            return redirect()->back();
        }
        try {
            // Get logged in user
            $user = Auth::user();

            $profile = Profile::find(Auth::id());
            // Update user info
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            // upload images
            if ($request->hasFile('avatar')) {
                $user->addMedia($request->avatar)->toMediaCollection('avatar');
            }

            $profile->update([
                'user_id' => $profile->user_id,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'occupation' => $request->occupation,
                'about' => $request->about,
                'address' => $request->address,
                'city' => $request->city,
                'post_code' => $request->post_code,
                'country' => $request->country,
                'state' => $request->state,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
            ]);
            // return with success msg
            notify()->success('Profile Successfully Updated.', 'Updated');
            return redirect()->route('profile.index');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            // return with error msg
            notify()->error($bug, 'Error');
            return redirect()->route('profile.index');
        }

    }

    public
    function updatePassword(Request $request)
    {
        // check validation for password match
        if (isset($request->password)) {
            $validator = Validator::make($request->all(), [
                'password' => 'required | confirmed'
            ]);
        }

        if ($validator->fails()) {
            notify()->error($validator->messages()->first(), 'Error');
            return redirect()->back();
        }

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_password, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                Auth::user()->update([
                    'password' => Hash::make($request->password)
                ]);
                notify()->success('Password Successfully Changed.', 'Success');
                Auth::logout();
                return redirect()->route('login');
            } else {
                notify()->warning('New password cannot be the same as old password.', 'Warning');
            }
        } else {
            notify()->error('Current password not match.', 'Error');
        }
        return redirect()->back();

    }
}
