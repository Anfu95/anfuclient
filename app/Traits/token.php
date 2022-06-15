<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Token {

  public function getAccessToken($user, $service)
  {
    $response = Http::withHeaders([
    'Accept' => 'application/json'
    ])->post('http://api.anfu.test/oauth/token', [
        'grant_type' => 'password',
        'client_id' => config('services.anfu.client_id'),
        'client_secret' => config('services.anfu.client_secret'),
        'username' => request('email'),
        'password' => request('password')
    ]);

    $acces_token = $response->json();

    $user->accessToken()->create([
        'service_id' => $service['data']['id'],
        'access_token' => $acces_token['access_token'],
        'refresh_token' => $acces_token['refresh_token'],
        'expires_at'=> now()->addSecond($acces_token['expires_in'])
    ]);
  }
}