<?php

namespace App;

use App\Model\Currency;
use App\Model\Kyc;
use App\Model\Wallet;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $passwordDev
 * @property string|null $uuid
 * @property string|null $kyc_verified_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \App\Model\Kyc $kyc
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereKycVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePasswordDev($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUuid($value)
 * @mixin \Eloquent
 * @property string|null $phone_code
 * @property string|null $citizenship_code
 * @property string|null $address
 * @property string|null $country_code
 * @property string|null $city
 * @property string|null $zip
 * @property string|null $id_code
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCitizenshipCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIdCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereZip($value)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'phone_code',
        'citizenship_code', 'address', 'country_code', 'city', 'zip', 'id_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'passwordDev'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'kyc_verified_at' => 'datetime',
    ];

    public function kyc()
    {
        return $this->hasOne(Kyc::class, "id", "uid");
    }

    public static function generateAddresses($user)
    {
        try {
            $uid = $user->id;

            // ============= generate btc and ethereum ============
            $token = \Hash::make('inphibitPay2019', [
                'rounds' => 10
            ]);
            $ref = 'test20191104';
            $token = str_replace("$2y$", "$2b$", $token);
            $cName = 'inphibit-pay';
            $crypto = 'btc';
            $currency = Currency::where('symbol', $crypto)->get();
            $client = new \GuzzleHttp\Client(['http_errors' => true]);
            $requestUrl = "http://websocket.inphibit.com/create-new-address/{$cName}/{$crypto}/{$ref}?token={$token}";
            $newWalletAddress = $client->request('GET', $requestUrl)->getBody()->getContents();
            if ($newWalletAddress !== 'not found') {
                Wallet::where('uid', $uid)->where('currency', $currency[0]->id)->update(['address' => $newWalletAddress]);
            }

            // ============ Ethereum goes here ================
            $client = new \GuzzleHttp\Client(['http_errors' => true]);
            $crypto = 'eth';
            $currency = Currency::where('symbol', $crypto)->get();
            $requestUrl = "http://websocket.inphibit.com/create-new-address/{$cName}/{$crypto}/{$ref}?token={$token}";
            $response = $client->request('GET', $requestUrl);
            $newWalletAddress = $response->getBody()->getContents();
            if ($newWalletAddress !== 'not found' || $response->getStatusCode() < 400) {
                Wallet::where('uid', $uid)->where('currency', $currency[0]->id)->update(['address' => $newWalletAddress]);
            }

        } catch (RequestException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            \Log::error($responseBodyAsString);
        }
    }

}
