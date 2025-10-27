<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Login;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class LoginGoogleController extends Controller
{

    protected $user;
    public function __construct()
    {
        $this->user = new Login();
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

   public function handleGoogleCallback()
{
    try {
        /** @var \Laravel\Socialite\Two\GoogleProvider $google */
        $google = Socialite::driver('google');
        $user = $google->stateless()->user(); // IDE không còn báo đỏ

        $finduser = $this->user->checkUserExistGoogle($user->id);

        if ($finduser) {
            session()->put('username', $finduser->username);
            return redirect()->intended('/');
        } else {
            $data_google = [
                'google_id' => $user->id,
                'fullName'  => $user->name,
                'username'  => 'user-google'. time(),
                'password'  => md5('12345678'),
                'email'     => $user->email,
                'isActive'  => 'y'
            ];

            $newUser = $this->user->registerAcount($data_google);

            if ($newUser && isset($newUser->username)) {
                session()->put('username', $newUser->username);
                return redirect()->intended('/');
            } else {
                return redirect()->back()->with('error', 'Có lỗi xảy ra trong quá trình đăng ký người dùng mới');
            }
        }
    } catch (Exception $e) {
        dd($e->getMessage());
    }
}

}
