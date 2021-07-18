<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Controllers\Controller;
use App\Models\Userprofile;
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

        $profile = Profile::with('user')->first();

        //  return $profile->user->get_roles_single();

        return view('backend.profile', compact('profile'));
    }


    public function store(Request $request)
    {
        return $request;


    }


    public function update(UpdateProfileRequest $request)
    {


        // Get logged in user
        $user = Auth::user();
        $userprofile = Profile::where('user_id', Auth::id())->first();
        // Update user info
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        // upload images
        if ($request->hasFile('avatar')) {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }


        if (empty($userprofile->bmi)) {
            $userprofile->update([
                'user_id' => $userprofile->user_id,
                'weight' => $weight,
                'height' => $height,
                'age' => $age,
                'gender' => $gender,
                'necksize' => $request->necksize,
                'dietrestrictions' => $request->dietrestrictions,
                'waist' => $request->waist,
                'bodyshape' => $request->bodyshape,
                'lifestylehabit' => $request->lifestylehabit,
                'bloodpresure' => $request->bloodpresure,
                'bloodsugar' => $request->bloodsugar,
                'foodhabit' => $request->foodhabit,
                'targetfitness' => $request->targetfitness,
                'bmi' => $bmi,
                'ponderalindex' => $pi,
                'bodyfat' => $bodyfat,
                'bmr' => $bmr,
                'bsa' => $bsa,

            ]);
            // return with success msg
            notify()->success('Profile Successfully Updated.', 'Updated');
            // return redirect()->back();
            return redirect()->route('app.profile.index');
        } else if ($userprofile->weight == $weight && $userprofile->height == $height && $userprofile->age == $age) {
            notify()->warning('Nothing is Update', 'Warning');
            return redirect()->back();
        } else {
            $userprofile->insert([
                'user_id' => $userprofile->user_id,
                'weight' => $weight,
                'height' => $height,
                'age' => $age,
                'gender' => $userprofile->gender,
                'necksize' => $request->necksize,
                'dietrestrictions' => $request->dietrestrictions,
                'waist' => $request->waist,
                'bodyshape' => $request->bodyshape,
                'lifestylehabit' => $request->lifestylehabit,
                'bloodpresure' => $request->bloodpresure,
                'bloodsugar' => $request->bloodsugar,
                'foodhabit' => $request->foodhabit,
                'targetfitness' => $request->targetfitness,
                'bmi' => $bmi,
                'ponderalindex' => $pi,
                'bodyfat' => $bodyfat,
                'bmr' => $bmr,
                'bsa' => $bsa,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            // return with success msg
            notify()->success('Profile Successfully inserted.', 'Insert');
            return redirect()->route('app.profile.index');

        }


    }

    public function updatePassword(Request $request)
    {
        // check validation for password match
        if(isset($request->password)){
            $validator = Validator::make($request->all(), [
                'password' => 'required | confirmed'
            ]);
        }

        if ($validator->fails()) {
            notify()->error('New password not matched.', 'Error');
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
