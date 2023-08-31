<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
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
}
