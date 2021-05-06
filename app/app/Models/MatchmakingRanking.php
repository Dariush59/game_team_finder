<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchmakingRanking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'from',
        'to',
        'description',
    ];

    public function import(){
        $ranks = [
            ['name' =>'Unranked', 'from' => null, 'to' => null,
                'description' =>'You have not been placed yet'],
            ['name' =>'Herald', 'from' => '0', 'to' => '799', 'description' =>''],
            ['name'=>'Guardian', 'from' => '800', 'to' => '1599', 'description' =>''],
            ['name' =>'Crusader', 'from' => '1600', 'to' => '2399', 'description' =>''],
            ['name'=>'Archon', 'from' => '2400', 'to' => '3199', 'description' =>''],
            ['name'=>'Legend', 'from' => '3200', 'to' => '3999', 'description' =>''],
            ['name'=>'Ancient', 'from' => '4000', 'to' => '4799', 'description' =>''],
            ['name' =>'Divine', 'from' => '4800', 'to' => '5599', 'description' =>''],
            ['name' =>'Immortal', 'from' => '5600', 'to' => null, 'description' =>'']
        ];
        foreach ($ranks as $rank) {
            $this->firstOrCreate([
                'name' => $rank['name'],
                'from' => $rank['from'],
                'to' => $rank['to'],
                'description' => $rank['description']
            ]);
        }
        return "MMR data has been imported.\n";
    }
}
