<?php

namespace App\Http\Controllers\Api\Front\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Products\ProductSearchRequest;
use App\Models\Posts\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {        
        $take = $request->take;
        $skip = $request->skip;
        $groups = $request->groups;
        $valid_from = $request->valid_from;

        $data = Post::valid()->with(['user', 'group'])
            ->when(!empty($groups), function($query) use($groups) {
                $query->whereHas('group', function($query) use($groups) {
                    $query->whereIn('id', $groups);
                });
            })->when(!empty($valid_from), function($query) use($valid_from) {
                $query->where('valid_from', '>=', $valid_from);
            })->latest();

        $allProducts = $data->count();

        $totalPages = ceil($data->count() / $take);
        $data = $data->skip($skip)->take($take)->get();

        return response()->json([
            'data' => $data,
            'totalPages' => $totalPages,
            'load_more' => ($allProducts - $take) > $skip,
        ]);
    }

    public function show(string $slug)
    {
        $data = Post::with(['user', 'stage', 'category', 'city', 'specialists', 'comments', 'comments.user'])->withCount(['specialists', 'approved_specialists'])->where('slug', $slug)->first();
        
        $data?->update([
            'views' => $data?->views + 1
        ]);

        if ($data && $data->idea_hide === 1) {
            // Change fields conditionally
            $data->description = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,';
            $data->problem = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,';
            $data->market = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,';
            // You can add or modify any other fields here
        }
        
        $similars = Post::active()->with(['user', 'stage', 'category', 'city'])->withCount(['specialists', 'approved_specialists'])->whereNot('slug', $slug)->take(6)->inRandomOrder()->get();
        /*$images = $data->getMedia('products')->map(function ($media) {
            return [
                'id' => $media->id,
                'original_url' => $media->getUrl(),
                'conversions' => collect($media->getGeneratedConversions())->mapWithKeys(function ($generated, $conversion) use ($media) {
                    return [$conversion => $generated ? $media->getUrl($conversion) : null];
                }),
            ];
        });*/

        //$userInfoService = new \App\Services\User\UserInfoService();

        return response()->json([
            'data' => $data,
            //'images' => $images,
            'similars' => $similars,
            //'auth' => auth('sanctum')->user() ? true : false,
            //'wish_details_filled' => $userInfoService->checkOrUserHaveFilledDetailsFowWish(),
        ]);
    }
}
