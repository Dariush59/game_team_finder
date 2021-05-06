<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dota2Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];



    public function import(){
        $positions = [
            ['name' =>'Carry'],
            ['name'=>'Mid lane'],
            ['name' =>'Off lane'],
            ['name'=>'Soft support'],
            ['name' =>'Hard support']];
        foreach ($positions as $position) {
            $this->firstOrCreate([
                'name' => $position['name'],
            ]);
        }
        return "Dota2 position data has been imported.\n";
    }
}
