<?php namespace Kumuwai\LocalStripe\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class StripeMetadata extends Eloquent
{
    protected $table = 'stripe_metadata';
    protected $guarded = [];
    public $timestamps = false;


    public static function create($attributes = [])
    {
        $params = array_merge($attributes,['id'=>'meta_'.uniqid()]);

        return parent::create($params);
    }


    public function customer()
    {
        return $this->belongsTo('Kumuwai\LocalStripe\Models\StripeCustomer', 'stripe_id');
    }

    public function card()
    {
        return $this->belongsTo('Kumuwai\LocalStripe\Models\StripeCard', 'stripe_id');
    }

    public function charge()
    {
        return $this->belongsTo('Kumuwai\LocalStripe\Models\StripeCharge', 'stripe_id');
    }

}
