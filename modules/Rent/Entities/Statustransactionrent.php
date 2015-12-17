<?php namespace Modules\Rent\Entities;
   
use Illuminate\Database\Eloquent\Model;

class statustransactionrent extends Model {

    protected $fillable = [];
    protected $table='STATUS_TRANSACTION_RENT';
    const UPDATE_AT='STATUS_TRANSACTION_RENT_UPDATE';
    public $timestamp=false;

}