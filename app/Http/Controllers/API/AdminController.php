<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index() {
        {
            $users = User::all(['name', 'email', 'password', 'role']); 
        
            return response()->json([
                'users' => $users
            ]);
        }
        // {
        //     $users = User::all(['name', 'email', 'password']);
        
        //     // Hiển thị hashed password
        //     foreach ($users as $user) {
        //         $user->hashed_password = bcrypt($user->password);
        //     }
        
        //     return response()->json([
        //         'users' => $users
        //     ]);
        // }
      
      }

}
