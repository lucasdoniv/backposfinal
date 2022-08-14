<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Validator;
use Laravel\Sanctum\PersonalAccessToken;

class FavoritesController extends Controller
{


    public function getFavorites(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $user = $token->tokenable;

        $favorite = Favorite::where('id_user', '=', $user->id)->get();

        return $favorite;
    }

    public function addFavorite(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $user = $token->tokenable;

        $favorite = Favorite::create([
            'id_user' => $user->id,
            'id_car' => $request->input('id_car'),
        ]);

        return $favorite;
    }

    public function destroy(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $user = $token->tokenable;

        $favorite = Favorite::where('id_user', '=', $user->id)->get();

        if (!$favorite->isEmpty()) {
            Favorite::where('id_user', '=', $user->id)->where('id_favorite', '=', $request->input('id_favorite'))->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
