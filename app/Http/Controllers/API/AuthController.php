<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|string|min:8',

        // ], [
        //     'name.required' => 'Yêu cầu nhập tên.',
        //     'email.required' => 'Yêu cầu nhập email.',
        //     'email.email' => 'Định dạng email không hợp lệ.',
        //     'email.unique' => 'Email đã được sử dụng.',
        //     'password.required' => 'Yêu cầu nhập mật khẩu.',
        //     'password.string' => 'Mật khẩu phải là một chuỗi.',
        //     'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',

        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // return response()->json(['message' => 'Create success'], 201);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'user', 
        ]);


        return response()->json(['message' => 'Người dùng đăng ký thành công']);
    }



    public function login(Request $request){
        
        // $user = User::where('email', $request->email)->first();
 
        // if (! $user || ! Hash::check($request->password, $user->password)) {
        //     throw ValidationException::withMessages([
        //         'email' => ['The provided credentials are incorrect.'],
        //     ]);



           
        // }
     
        // return response()->json(['mesages' => "login successgully", 'tocken' => $user->createToken('token')->plainTextToken], 201 );

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;

            return response()->json(['token' => $token, 'user' => $user]);
        }

        return response()->json(['message' => 'Thông tin đăng nhập không hợp lệ'], 401);

}
        public function logout()
        {
            Auth::logout();

            return response()->json(['message' => 'Đăng xuất thành công']);
        }
        
    
}
