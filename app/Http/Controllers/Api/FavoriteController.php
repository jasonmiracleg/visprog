<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoritResource;
use App\Models\Favorit;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FavoriteController extends Controller
{
    public function ListFavorit(Request $request): array
    {
        $user = User::where("id", $request->id)->first();
        $favorits = $user->favorits()->get();

        return [
            "status" => Response::HTTP_OK,
            "message" => "Success",
            "data" => FavoritResource::collection($favorits)
        ];
    }

    public function createFavorit(Request $request)
    {
        $favorit = new Favorit();
        $favorit->user_id = $request->user_id;
        $favorit->movie_id = $request->movie_id;
        $favorit->save();

        return [
            "status" => Response::HTTP_OK,
            "message" => "Success",
            "data" => $favorit
        ];
    }

    public function deleteFavorit(Request $request)
    {
        $favorit = Favorit::where("id", $request->id)->first();
        $favorit->delete();

        return [
            'status' => Response::HTTP_OK,
            'message' => 'Success',
            'data' => $favorit
        ];
    }
}
