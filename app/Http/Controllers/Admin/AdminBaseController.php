<?php

namespace App\Http\Controllers\Admin;

use App\GlobalSetting;
use App\LanguageSetting;
use App\OfflinePlanChange;
//use App\Traits\FileSystemSettingTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use App\PushNotificationSetting;
use App\Models\ModulePermission;

class AdminBaseController extends Controller
{
    //use FileSystemSettingTrait;

    /**
     * @var array
     */
    public $data = [];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[ $name ]);
    }

    /**
     * UserBaseController constructor.
     */
    public function __construct()
    {
        //parent::__construct();

        $this->middleware(function ($request, $next) {

            $this->user    = auth()->user();
            
            $modules       = ModulePermission::where('roles_id', $this->user->roles->first()->id)->value('modules');
            $this->modules = explode(',',$modules);
            \View::share('modules', $this->modules);

            return $next($request);
        });

        

       
    }
}
