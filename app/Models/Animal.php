<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Animal extends Model
{
    use HasFactory;
    protected $fillable = ['name','date_of_birth', 'user_id', 'description'];

    public static function getAnimalTypes(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM animals WHERE Field = "type"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
}
