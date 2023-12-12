<?php
// this class will convert all the data into json
namespace App\Http\Resources;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // the left one is the key and the right one is the attributes of the table
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'age' => $this->age,
            'password' => $this->password,
            'profile_picture' => $this->profile_picture
        ];
    }
}
