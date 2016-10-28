<?php

namespace WI\Chart;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'company_id', 'label', 'description','config','status','updated_by_user_id'
	];



  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [
    //'password', 'remember_token',
  ];

	protected $casts = [
		'configx' => 'json'
	];


	public function updated_by_user(){
		return $this->belongsTo('WI\User\User','updated_by_user_id');
	}









  public function getEnabled(){
    //$backtrace = debug_backtrace();
    //dc('Mu name is '.$backtrace[1]['function'].', and I have called him! Muahahah!');
    return $this->where('status','<>','disabled')->get();
    return $this->where('status','<>','disabled')->orderBy('identifier','ASC')->get();
  }


  /*
   * Relations
   */

	public function company(){
		return $this->belongsTo('WI\Core\Entities\Company\Company');			//foreign key belongsTo
	}


}
