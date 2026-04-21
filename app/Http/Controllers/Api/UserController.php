<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // Import Storage facade
use App\Http\Resources\UserResource; // Assuming you have a UserResource
use App\Http\Requests\UpdateProfileRequest; // Import UpdateProfileRequest
use App\Http\Requests\ChangePasswordRequest; // Import ChangePasswordRequest

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $users = User::paginate(10);
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\UserResource|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            // Add other validation rules as needed based on your User model's fillable fields
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // Fill other fields if necessary
        ]);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \App\Http\Resources\UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage (for profile update).
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @param  \App\Models\User  $user
     * @return \App\Http\Resources\UserResource|\Illuminate\Http\JsonResponse
     */
        public function update(UpdateProfileRequest $request, User $user)
        {
            // Handle image upload if present for the specific user
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($user->image && Storage::disk('public')->exists($user->image)) {
                    Storage::disk('public')->delete($user->image);
                }
                $imagePath = $request->file('image')->store('images/profile', 'public');
                $user->image = $imagePath;
            }
    
            // Update other user data for the specific user
            $user->fill($request->except(['password', 'image']));
            $user->save();
    
            return new UserResource($user);
        }
    
        /**
         * Update the authenticated user's profile.
         *
         * @param  \App\Http\Requests\UpdateProfileRequest  $request
         * @return \App\Http\Resources\UserResource|\Illuminate\Http\JsonResponse
         */
        public function updateMyProfile(UpdateProfileRequest $request)
        {
            $user = $request->user(); // Get the authenticated user
    
            // Handle image upload if present
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($user->image && Storage::disk('public')->exists($user->image)) {
                    Storage::disk('public')->delete($user->image);
                }
                $imagePath = $request->file('image')->store('images/profile', 'public');
                $user->image = $imagePath;
            }
    
            // Update other user data
            $user->fill($request->except(['password', 'image'])); // Exclude password and image as they are handled separately
            $user->save();
    
            return new UserResource($user);
        }

    /**
     * Change the authenticated user's password.
     *
     * @param  \App\Http\Requests\ChangePasswordRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user(); // Get the authenticated user

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'The provided current password does not match our records.'], 400);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 204);
    }
}
