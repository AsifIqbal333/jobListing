<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    protected $fillable = ['user_id','title','company','location','website','email','tags','description','logo'];
    
    use HasFactory;

    // public static function data(){
    //     return [
    //         [
    //             'id'            =>  1,
    //             'title'         =>  'Listing one',
    //             'description'   =>  'Lorem Ipsum dolor Lorem Ipsum dolorLorem Ipsum dolor'
    //         ],
    //         [
    //             'id'            =>  2,
    //             'title'         =>  'Listing two',
    //             'description'   =>  'Lorem Ipsum dolor Lorem Ipsum dolorLorem Ipsum dolor'
    //         ]

    //         ];
    // }

    // public static function findSingleListing($id){
    //     $listings = self::data();
        
    //     foreach($listings as $listing){
    //         if($listing['id']==$id){
    //             return $listing;
    //         }    
    //     }
        
    // }

    public function scopeFilter($query, array $filters){
        
        //if tag contains a value
        if($filters['tag'] ?? false){
            $query->where('tags', 'like', '%'. $filters['tag'] . '%');
        }

        //if search contains value
        if($filters['search'] ?? false){
            $query->where('title', 'like', '%'. $filters['search'] . '%')
            ->orWhere('description', 'like', '%'. $filters['search'] . '%')
            ->orWhere('tags', 'like', '%'. $filters['search'] . '%');
        }
    }

    //Relationship to user
    public function user(){
        // we dont need to define foreign key name because it will pick
        //automatically because of the naming conventions
        //return $this->belongsTo(User::class,'user_id');
        
        //Without defining foreign key name
        return $this->belongsTo(User::class,'user_id');

    }
}
