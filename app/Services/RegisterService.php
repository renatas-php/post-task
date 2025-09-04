<?php 

namespace App\Services;

use App\Models\Posts\Group;

class RegisterService {

    public function getRandomGroupId():int
    {
        $groups = Group::pluck('id')->toArray();

        if($groups && is_array($groups))
        {
            return $groups[array_rand($groups)];
        }

        $group = Group::create([
            'name' => 'test',
        ]);

        return $group->id;
    }

}