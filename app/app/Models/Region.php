<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function import(){
        $regions = [
            ['name' =>'CIS'],
            ['name'=>'EU'],
            ['name'=>'NA'],
            ['name' =>'SEA']];
        foreach ($regions as $region) {
            $this->firstOrCreate([
                'name' => $region['name'],
            ]);
        }
        return "Regions has been imported.\n";
    }
}
