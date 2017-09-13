<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User as ProviderUser;

class AuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')
                        ->with(['prompt' => 'select_account'])
                        ->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $validDomain = 'std.stei.itb.ac.id';
        $providerUser = Socialite::driver('google')->user();
        $redirectUrl = '';
        $message = '';

        //validate email domain
        $email = $providerUser->getEmail();
        $emailDomain = substr($email, strrpos($email, '@') + 1);
        if(strcmp($emailDomain, $validDomain) == 0){
            $user = $this->authenticate($providerUser);
            Auth::login($user);
            
            $redirectUrl = '/home';

        } else {
            $redirectUrl = '/';
            $message = 'Invalid email, please use your std.stei.itb.ac.id email';
        }

        return redirect()->to($redirectUrl)->with('message', $message);
    }

    public function authenticate(ProviderUser $providerUser)
    {

        $user = User::whereEmail($providerUser->getEmail())
                        ->first();

        if ($user) {
            return $user;

        } else {
            $user = new User([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'role' => 'programmer',
            ]);
            $user->save();

            return $user;
        }
    }
}