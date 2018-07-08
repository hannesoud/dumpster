<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CompanyImage;

class Company extends Model
{
    //
    protected $table = 'companies';

    protected $fillable = [
        'name',
        'code',
        'avatar_id',
        'license_number',
        'description',
        'address',
        'latitude',
        'longitude',
        'phone',
        'status',
        'web_site',
        'user_id',
        'reason',
        'email'
    ];

    protected $hidden = [
        'password',
    ];

    const CREATED_AT = 'reg_date';

    const COMPANY_STATUS_REVIEW = 1;
    const COMPANY_STATUS_ACTIVE = 2;
    const COMPANY_STATUS_BANNED = 3;
    const COMPANY_STATUS_PAUSED = 4;

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getStatusNameAttribute()
    {
        $status_name = '';
        switch ($this->status) {
            case 1:
                $status_name = "REVIEW";
                break;
            case 2:
                $status_name = "ACTIVE";
                break;
            case 3:
                $status_name = "BANNED";
                break;
            case 4:
                $status_name = "PAUSED";
                break;
            default:
                $status_name = "REVIEW";
                break;
        }

        return $status_name;
    }

    /*
     * Get company's avatar image full name
     * */

    public function getAvatarImageAttribute()
    {
        $image = CompanyImage::find($this->avatar_id);
        if ($image) {
            return $image->filename;
        }
    }


}
