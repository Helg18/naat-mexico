<?php
namespace App\Models;

use Caffeinated\Shinobi\Facades\Shinobi;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Traits\ModelableTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, ShinobiTrait, ModelableTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public static function company(){
        return \Auth::user()->companies()->first();
    }

    public function companies()
    {
        return $this->belongsToMany('\App\Models\Company')->withTimestamps();
    }

    public function quizzes()
    {
        return $this->belongsToMany('\App\Models\Quiz')->withTimestamps();
    }

    public function survey_respondent(){
        return $this->hasOne('\App\Models\UserSurveyRespondent');
    }


    static function allWithSecurity(){


        if(Shinobi::is('customer')){
            //Only my own company
            return self::whereRaw(DB::raw("id IN (SELECT user_id FROM company_user WHERE company_id=".self::company()->id.")"))->get();
        }else{
            return self::all();
        }

    }

    function canRoles(){
        if(Shinobi::is('super')){
            return Role::where('id',3)->get(); //only operators
        }

        return Role::all();
    }

    function canDelete(){

        //Validate
        return true;
    }

    static function canAutorizeOpening($email,$password){
        $user = self::where('email',$email)->first();
        if(!$user || !Hash::check($password, $user->password) || !$user->can('turn.authorize')){
            return false;
        }
        return $user;
    }

    static function actives($onlyCount = false){

        $data = self::where('is_active',1);

        if($onlyCount){
            $tmp = $data->count();
        }else{
            $tmp = $data->get();
        }

        return $tmp;
    }

    static function signUp($request){
        if($user = self::where('email',$request->email)->first()){
            return false;
        }

        $user = new self();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_active = true;
        $user->save();
        $user->assignRole(4);

        $user->survey_respondent()->create([
            'nse_points'        =>  0,
            'earned_points'     =>  0,
            'last_name'         =>  $request->last_name,
            'day_of_birth'      =>  $request->day_of_birth,
            'sex'               =>  $request->sex,
            'marital_status'    =>  $request->marital_status,
            'state'             =>  $request->state,
            'city'              =>  $request->city,
            'zip'               =>  $request->zip,
            'address'           =>  $request->address
        ]);

        return $user;

    }

    public function haveNsl(){
        return $this->survey_respondent ? $this->survey_respondent->nse_points : null;
    }

    public function calculateEarnedPoints(){
        $tmp = DB::table('quiz_user')
            ->selectRaw(DB::raw("
                sum(earned_points) as earned_points
                "))
            ->where('user_id',$this->id)
            ->first();

        $this->survey_respondent()->update(['earned_points'=>$tmp->earned_points]);

    }

    public function jsonProfile(){
        return [
            'id'                =>  $this->id,
            'email'             =>  $this->email,
            'name'              =>  $this->name,
            'last_name'         =>  $this->survey_respondent ? $this->survey_respondent->last_name : '',
            'earned_points'     =>  $this->survey_respondent ? (int)$this->survey_respondent->earned_points : '0',
            'nse_points'        =>  $this->survey_respondent ? (int)$this->survey_respondent->nse_points : '0',
            'day_of_birth'      =>  $this->survey_respondent ? $this->survey_respondent->day_of_birth : '',
            'age'               =>  $this->survey_respondent ? $this->survey_respondent->age : '',
            'sex'               =>  $this->survey_respondent ? $this->survey_respondent->sex : '',
            'marital_status'    =>  $this->survey_respondent ? $this->survey_respondent->marital_status : '',
            'state'             =>  $this->survey_respondent ? $this->survey_respondent->state : '',
            'city'              =>  $this->survey_respondent ? $this->survey_respondent->city : '',
            'zip'               =>  $this->survey_respondent ? $this->survey_respondent->zip : '',
            'address'           =>  $this->survey_respondent ?  $this->survey_respondent->address : '',

            'nse'               =>  $this->survey_respondent && $this->survey_respondent->nse() ? $this->survey_respondent->nse()->name : '---',
        ];
    }
}