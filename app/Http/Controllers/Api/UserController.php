<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function getAllUser()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    public function checkPassword()
    {
        $users = User::all(); //Connect to database immediately and automatically close the DB
        $check = [];
        foreach ($users as $user) {
            array_push($check, Hash::check("nolan123", $user->password));
        }
        return $check;
    }

    public function createUser(Request $request /*this variable get the data from android studion in json*/)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->age = $request->age;
            $user->phone = $request->phone;
            $user->save();

            // User::create($request); -- Passsing the model from the android studio
            return [
                'status' => Response::HTTP_OK,
                'message' => "Success",
                'data' => $user
            ];
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
    }

    public function updateUser(Request $request)
    {
        if (!empty($request->email)) {
            $user = User::where('email', $request->email)->first();
        } else {
            $user = User::where('id', $request->id)->first();
        }

        if (!empty($user)) {
            try {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->age = $request->age;
                $user->phone = $request->phone;
                $user->save();

                return [
                    'status' => Response::HTTP_OK,
                    'message' => "Success",
                    'data' => $user
                ];
            } catch (Exception $e) {
                return [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                    'data' => []
                ];
            }
        } else {
            return [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => "User not Found",
            ];
        }
    }

    public function deleteUser(Request $request)
    {
        if (!empty($request->email)) {
            $user = User::where('email', $request->email)->first();
        } else {
            $user = User::where('id', $request->id)->first();
        }

        if (!empty($user)) {
            $user->delete();
            return [
                'status' => Response::HTTP_OK,
                'message' => "Success",
                'data' => []
            ];
        } else {
            return [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => "User not Found",
            ];
        }
    }
}
