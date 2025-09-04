<?php

namespace App\Http\Controllers\Api\Front\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Group;

class PostHelperController extends Controller
{
    public function postLists()
    {
        $categories = Group::orderBy('name')->get();

        return response()->json([
            'categories' => $categories,
        ]);
    }
}
