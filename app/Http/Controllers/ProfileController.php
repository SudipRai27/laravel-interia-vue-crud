<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileUpdateRequest;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return Inertia::render('Profile/Edit', [
            'profile' => [
                'image' => $request->user()->getFirstMediaUrl('image')
            ]
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = auth()->user();
        $user->update($request->validated());
        if ($request->hasFile('image')) {
            $media = $user->getFirstMedia('image');
            if ($media) {
                $media->delete();
            }
            $user->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return redirect()->route('profile.edit')->with([
            'success' => 'Profile Updated Successfully'
        ]);;
    }
}