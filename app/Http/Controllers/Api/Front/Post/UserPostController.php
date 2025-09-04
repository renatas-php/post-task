<?php

namespace App\Http\Controllers\Api\Front\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\PostStoreRequest;
use App\Models\User;
use App\Models\Posts\Post;
use Illuminate\Support\Str;

class UserPostController extends Controller
{
    public function index(Request $request)
    {        
        $take = $request->take;
        $skip = $request->skip;

        $data = Post::where('person_id', auth('sanctum')->id())->with(['user', 'group'])->latest();

        $totalPages = ceil($data->count() / $take);
        $data = $data->skip($skip)->take($take)->get();

        return response()->json([
            'data' => $data,
            'totalPages' => $totalPages,
        ]);
    }

    public function store(PostStoreRequest $request)
    {
        $user = User::where('id', auth('sanctum')->id())->firstOrFail();

        Post::create([
            'person_id' => $user?->id,
            'group_id' => $user?->group?->id,
            'name' => $request->name,
            'content' => $request->content,
            'valid_from' => $request->valid_from,
            'slug' => Str::slug($request->name),
        ]);
    }

    public function edit(int $id)
    {
        $data = Post::where('person_id', auth('sanctum')->id())->where('id', $id)->firstOrFail();
        
        return response()->json([
            'data' => $data,
        ]);
    }

    public function update(int $id, PostStoreRequest $request)
    {
        $data = Post::where('person_id', auth('sanctum')->id())->where('id', $id)->firstOrFail();

        $data->update([
            'name' => $request->name,
            'content' => $request->content,
            'valid_from' => $request->valid_from,
            'slug' => Str::slug($request->name),
        ]);
    }

    public function destroy(int $id)
    {
        $data = Post::where('person_id', auth('sanctum')->id())->where('id', $id)->firstOrFail();
        $data?->delete();
        
        return response()->json([
            'data' => $data,
        ]);
    }
}
