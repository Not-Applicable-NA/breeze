<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Google\Service\Calendar;
use Google\Service\Oauth2;
use Google_Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GoogleLoginController extends Controller
{
    private Google_Client $client;

    public function __construct() {
        $this->client = new Google_Client();
        $this->client->setApplicationName('Google Calendar API');
        $this->client->setScopes([Calendar::CALENDAR_EVENTS, Oauth2::USERINFO_PROFILE, Oauth2::USERINFO_EMAIL, Oauth2::OPENID]);
        $this->client->setAuthConfig(storage_path('app/google-calendar/oauth-credentials.json'));
        $this->client->setAccessType('offline');
        $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
    }

    // OAuthプロバイダへリダイレクト
    public function redirectToGoogle()
    {
        return redirect($this->client->createAuthUrl());
    }

    // 認証後コールバック
    public function handleGoogleCallback(Request $request)
    {
        try {
            $tokenPath = storage_path('app/google-calendar/oauth-token.json');
            if (file_exists($tokenPath)) {
                $accessToken = json_decode(file_get_contents($tokenPath), true);
                $this->client->setAccessToken($accessToken);
            }

            if ($this->client->isAccessTokenExpired() && $this->client->getRefreshToken()) {
                $accessToken = $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                $this->client->setAccessToken($accessToken);
            }

            if ($this->client->isAccessTokenExpired()) {
                $authCode = $request->code;
                $accessToken = $this->client->fetchAccessTokenWithAuthCode($authCode);
                $this->client->setAccessToken($accessToken);

                if (array_key_exists('error', $accessToken)) {
                    throw new \Exception(join(', ', $accessToken));
                }
                file_put_contents($tokenPath, json_encode($this->client->getAccessToken()));
            }
            
            $OAuthService = new Oauth2($this->client);
            $userInfo = $OAuthService->userinfo_v2_me->get();
            $token = $this->client->getAccessToken();

            $user = User::updateOrCreate(
                [ 'google_id' => $userInfo->getId() ],
                [
                    'name' => $userInfo->getName(),
                    'email' => $userInfo->getEmail(),
                    'google_access_token' => $token['access_token'],
                    'google_refresh_token' => $this->client->getRefreshToken()
                ]
            );

            Auth::login($user);

            if (!$user->class) {
                session()->flash('flash_message', '所属クラスを設定してください');
                return redirect()->route('profile.edit');
            } else {
                return redirect()->route('dashboard');
            }
            
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
