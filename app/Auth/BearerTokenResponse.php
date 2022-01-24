<?php


namespace App\Auth;


use App\Model\Wallet;
use App\User;
use Log;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
class BearerTokenResponse extends \League\OAuth2\Server\ResponseTypes\BearerTokenResponse
{
    protected function getExtraParams(AccessTokenEntityInterface $accessToken): array
    {
        $user = User::find($this->accessToken->getUserIdentifier());
        // check if user has all wallets
        Log::info('checkUserWallets ' . $this->accessToken->getUserIdentifier());
        Wallet::checkUserWallets($this->accessToken->getUserIdentifier());
        return [
            'user_id' => $this->accessToken->getUserIdentifier(),
            'name'=>$user->name,
            'email'=>$user->email,
            'phone'=>$user->phone
        ];
    }
}