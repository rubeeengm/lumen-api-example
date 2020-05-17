<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Exceptions\AccessDeniedEception;
use App\Repositories\Interfaces\IIdentityRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IdentityRepository implements IIdentityRepository {

    /**
     * @inheritDoc
     * @throws AccessDeniedEception
     */
    public function signin(string $email, string $password): array {
        //find user by email
        $entry = User::where('email', $email)->first();

        if (!$entry) {
            throw new AccessDeniedEception('Access denied');
        }

        //compare password
        if (!Hash::check($password, $entry->password)) {
            throw new AccessDeniedEception('Access denied');
        }

        $entry->api_token = Str::random(20);
        $entry->api_token_expiration = Carbon::now()->addHours(10);

        $entry->save();

        return [
            'acces_token' => $entry->api_token
            , 'expiration' => $entry->api_token_expiration
            , 'user' => [
                'id' => $entry->id
                , 'name' => $entry->name
                , 'email' => $entry->email
            ]
        ];
    }
}
