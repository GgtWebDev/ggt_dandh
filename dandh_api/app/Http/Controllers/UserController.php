<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\PasswordReset;

class UserController extends Controller
{
    use HttpResponses;

    public function index()
    {
    }

    public function register(UserRegisterRequest $request)
    {

        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type ?? 'user'
        ]);

        $token = $user->createToken('Api token of' . $user->name)->plainTextToken;

        return $this->success([
            'user' => $user,
            'token' => $token
        ], 'user created successfully', 201);
    }


    public function login(UserLoginRequest $request)
    {

        $request->validated($request->all());

        // dd($request->user_name);
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Credentials do not match !', 401);
        }

        $user = User::where(['email' => $request->email])->first();

        $token = $user->createToken('Api token of' . $user->name)->plainTextToken;

        return $this->success(
            [
                'user' => $user,
                'token' => $token
            ],
            'Welcome user !'
        );
    }


    public function logout()
    {

        dd(Auth::user());

        // @noinspection PhpUnusedLocalVariableInspection
        Auth::user()->currentAccessToken()->delete();

        return $this->success(
            null,
            'Successfully logged out!'
        );
    }



    public function forget(Request $request)
    {
        // $this->validate($request, ['email' => 'required|email']);

        // $response = Password::sendResetLink(
        //     $request->only('email')
        // );

        // switch ($response) {
        //     case Password::RESET_LINK_SENT:
        //         return response()->json(['message' => 'Reset link sent to your email.']);
        //     case Password::INVALID_USER:
        //         return response()->json(['message' => 'Email not found.'], 404);
        // }



        $request->validate([
            'email' => 'required|email'
        ]);

        // Get the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with the given email address']);
        }

        // Generate a reset token for the user
        $token = Str::random(60);
        $user->update(['reset_token' => $token]);

        // Build the reset URL
        $reset_url = url('/reset_view') . "?token=$token&email=" . urlencode($user->email);

        // Send the password reset email with the reset URL
        $data = [
            'email' => $user->email,
            'url' => $reset_url,
            'sub' => 'Password Reset Notification !',
        ];

        Mail::send('passwordMail', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['sub']);
        });

        $reset = PasswordReset::updateOrCreate(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now()->format('Y-m-d H:i:s')
            ]
        );

        if ($reset) return $this->success(null, 'message sent', 200);

        return $this->error(null, 'Error occured! Try again', 200);
    }


    public function reset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $credentials = $request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        );


        $user = User::where('email', $request->email)->first();
        // $user = User::find($request->id);
        $user->password = bcrypt($request->password);
        $user->save();

        PasswordReset::where('email', $request->email)->delete();

        return $this->success(null, 'Password reset successful !');

        // $response = Password::reset($credentials, function ($user, $password) {
        //     $user->password = bcrypt($password);
        //     $user->save();
        // });

        // switch ($response) {
        //     case Password::PASSWORD_RESET:
        //         return response()->json(['message' => 'Password reset successfully.']);
        //     default:
        //         return response()->json(['message' => 'Failed to reset password.'], 400);
        // }
    }



    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();
    }

    protected function getEmailSubject()
    {
        return 'Your Password Reset Link';
    }
}
