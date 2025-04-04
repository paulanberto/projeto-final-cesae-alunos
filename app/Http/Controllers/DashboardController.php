<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        return view('dashboard');
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $userId = $user->id;

        // Define path for user profile images
        $path = public_path('imagens/profile/' . $userId);

        // Create directory if it doesn't exist
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // Get all files in the directory and delete them (old profile pics)
        $files = glob($path . '/*');
        foreach($files as $file) {
            if(is_file($file)) {
                unlink($file);
            }
        }

        // Save the new image
        $imageName = 'profile-' . $userId . '.' . $request->profile_image->extension();
        $request->profile_image->move($path, $imageName);

        return redirect()->route('dashboard.view')->with('success', 'Imagem de perfil atualizada com sucesso!');
    }



    public function deleteOwnAccount(Request $request)
{
    $user = Auth::user();
    $userId = $user->id;

    // First, get all post IDs for this user
    $postIds = DB::table('posts')->where('user_id', $userId)->pluck('id')->toArray();

    // Delete from post_tag first (the join table)
    if (!empty($postIds)) {
        DB::table('post_tag')->whereIn('post_id', $postIds)->delete();
    }

    // Then delete the user's posts
    DB::table('posts')->where('user_id', $userId)->delete();

    // Log out the user
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Now delete the user
    DB::table('users')->where('id', $userId)->delete();

    // Redirect to login page with message
    return redirect()->route('login')->with('success', 'A sua conta foi apagada com sucesso.');
}


    public function politicas()
    {
        return view('politicas');
    }
}