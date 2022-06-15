<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function store()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.auth()->user()->accessToken->access_token
        ])->post('http://api.anfu.test/v1/posts', [
            'name' => 'Este es un nombre de prueba',
            'slug' => 'esto-es-un-nombre-de-prueba',
            'extract' => 'asdgertasd',
            'body' => 'asdgbniortkmosdngier',
            'category_id' => 1
        ]);

        return $response->json();
    }
}
