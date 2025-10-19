<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAvatarRequest;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //

    public function web_login(LoginRequest $request)
    {

        $data = $request->validated();

        $auth = Auth::attempt($data);

        if ($auth) {
            $user = Auth::user();

            $token = $user->createToken('web', explode(',', $user->roles));

            $user['token'] = $token->plainTextToken;

            Mail::to($request->email)
                ->send(new WelcomeMail($user, 3500));

            return $this->success(data: $user);
        }

        return $this->fail(400);
    }

    public function mobile_login(LoginRequest $request)
    {

        $data = $request->validated();

        $auth = Auth::attempt($data);

        if ($auth) {
            $user = Auth::user();

            $token = $user->createToken('mobile', ['show_users']);

            $user['token'] = $token->plainTextToken;

            return $user;
        }

        return 'No';

    }

    public function active_sessions()
    {
        // $user = Auth::user();
        $user = auth()->user();
        return $user->tokens;
    }

    public function logout_session($id)
    {
        $session = auth()->user()->tokens()->where('id', $id)->first();

        $status = $session ? $session->delete() : false;

        if ($status)
            return 'Session Deleted Successfully';
        else
            return 'Session not found';

    }

    public function logout_current()
    {
        $seesion = auth()->user()->currentAccessToken();

        if ($seesion)
            return $seesion->delete();
        else
            return 'No active session';
    }

    public function logout_others()
    {
        $activeSeesion = auth()->user()->currentAccessToken();

        $Deleted = auth()->user()->tokens()->whereNot('id', $activeSeesion->id)->delete();

        // return $allActiveSessions;

        if ($Deleted)
            return 'Logged out from other sessions successfully';
        else
            return 'No active session';
    }

    public function logout_all()
    {

        $Deleted = auth()->user()->tokens()->delete();

        if ($Deleted)
            return 'Logged out from all sessions successfully';
        else
            return 'No active session';
    }

    public function register(RegisterRequest $request)
    {

        $user = User::create($request->validated());

        return $user;

    }

    public function change_photo(AddAvatarRequest $request)
    {
        $file = $request->file('avatar');
        $ext = $file->getClientOriginalExtension();
        $uid = auth()->user()->id;

        $fileName = "$uid.$ext";

        return $file->storeAs('avatars', $fileName, 'mine');
    }
}