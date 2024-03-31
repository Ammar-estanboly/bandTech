<?php

namespace App\Models\products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'is_active',
        'slug',
    ];

    //public scope to return is_active product
    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }


    public function getPriceAttribute($value)
    {
        return json_decode($value);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = json_encode($value);
    }




        // Getter to generate Image URL with asset() helper
        public function getImageAttribute($value){
            if($value){
                return asset($value);
            }else{
                // Return default image URL or path if no image is set
                return asset('images/default-product.png'); // Example default image
            }
        }//getimageAttribute


        //handel update image case and remove asset link before save to db
        public function setImageAttribute($value){
            if(strpos($value,asset('') ) !== false){
                $this->attributes['image'] = $this->attributes['image'];
            }else{
                $this->attributes['image'] = $value;
            }

        }//setimageAttribute



}
