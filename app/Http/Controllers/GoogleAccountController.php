<?php

namespace App\Http\Controllers;

use App\Models\GoogleAccount;
use App\Models\User;
use App\Services\Google;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('accounts', [
            'accounts' => auth()->user()->googleAccounts,
        ]);
    }


    public function store(Request $request, Google $google)
    {
        if (!$request->has('code')) {
            // Send the user to the OAuth consent screen.
            return redirect($google->createAuthUrl());
            // return Socialite::driver('google')->redirect();

        }

        // Use the given code to authenticate the user.
        $google->authenticate($request->get('code'));

        // Make a call to the Google+ API to get more information on the account.
        $account = $google->service('Oauth2');
        $userInfo = $account->userinfo->get();

        auth()->user()->googleAccounts()->updateOrCreate(
            [
                'google_id' => $userInfo->id,
            ],
            [
                'name' =>$userInfo->email,
                'token' => $google->getAccessToken(),
            ]
        );



        // Return to the account page.
        return redirect()->route('google.index');
    }



    public function destroy(GoogleAccount $googleAccount, Google $google)
    {
        $googleAccount->delete();

        // Event though it has been deleted from our database,
        // we still have access to $googleAccount as an object in memory.
        $google->revokeToken($googleAccount->token);

        return redirect()->back();
    }
}
