<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Device
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Device query()
 * @mixin \Eloquent
 */
class Device extends Model
{
    protected $accept;
    protected $userAgent;
    protected $isMobile = false;
    protected $isAndroid = null;
    protected $isBlackberry = null;
    protected $isIphone = null;
    protected $isIpad = null;
    protected $isOpera = null;
    protected $isPalm = null;
    protected $isWindows = null;
    protected $isGeneric = null;
    protected $devices = array(
        "android" => "android",
        "blackberry" => "blackberry",
        "iphone" => "(iphone|ipod)",
        "ipad" => "ipad",
        "opera" => "opera mini",
        "palm" => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)",
        "windows" => "windows ce; (iemobile|ppc|smartphone)",
        "generic" => "(kindle|mobile|mmp|midp|o2|pda|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap)"
    );

    public function isMobile() {
        $this->userAgent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $this->accept = isset( $_SERVER['HTTP_ACCEPT'] ) ? $_SERVER['HTTP_ACCEPT'] : '';
        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])|| isset($_SERVER['HTTP_PROFILE'])) {
            $this->isMobile = true;
        } elseif (strpos($this->accept,'text/vnd.wap.wml') > 0 || strpos($this->accept,'application/vnd.wap.xhtml+xml') > 0) {
            $this->isMobile = true;
        } else {
            foreach ($this->devices as $device => $regexp) {
                if ($this->isDevice($device)) {
                    $this->isMobile = true;
                }
            }
        }

        return $this->isMobile;
    }
    protected function isDevice($device) {
        $var = "is" . ucfirst($device);
        $return = $this->$var === null ? (bool) preg_match("/" . $this->devices[$device] . "/i", $this->userAgent) : $this->$var;
        if ($device != 'generic' && $return == true) {
            $this->isGeneric = false;
        }
        return $return;
    }
}
