<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Company
 *
 * @property int $id
 * @property string $name
 * @property int $activated
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $address
 * @property int|null $convert_currency_id
 * @property string|null $token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Company whereActivated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Company whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Company whereConvertCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Company whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Company whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Company extends Model
{
    protected $fillable = ['name','actiated'];

    public static function getName($company_id){
        $company = Company::where('id',$company_id)->select('name')->get();
        return $company[0]->name;
    }
}
