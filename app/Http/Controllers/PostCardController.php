<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use UserService;
use App\PostCard;
use DB;
use App\Media;
use Storage;
use Uuid;

class PostCardController extends Controller
{
    public function index()
    {
        $postcards = PostCard::all();
        foreach($postcards as $postcard)
        {
            $medias = $postcard->medias;
            $postcard->user;
            foreach($medias as $media)
            {
                if($media->type == 1)
                {
                    $fileName = $media->url;
                    $url = env('PICTURE_PATH') . $fileName;
                    $media->url = $url;
                }
            }
        }
        return response()->json($postcards, 200, [],JSON_NUMERIC_CHECK);
    }

    public function store()
    {
        $datas = request()->all();
        $user = UserService::findUserByToken(request());

        $card = new PostCard();
        $card->latitude = $datas['latitude'];
        $card->longitude = $datas['latitude'];
        $card->message = $datas['message'];
        $card->title = $datas['title'];
        $card->user_id = $user->id;

     //   DB::beginTransaction();
        $card->save();

        $videos = $datas['videos'];
        foreach($videos as $video)
        {
            $media = new Media();
            $media->postcard_id = $card->id;
            $media->url = $video['data'];
            $media->description = $video['description'];
            $media->type = 2;
            $media->save();
        }
        $musics = $datas['musics'];
        foreach($musics as $music)
        {
            $media = new Media();
            $media->postcard_id = $card->id;
            $media->url = $music['data'];
            $media->description = $music['description'];
            $media->type = 3;
            $media->save();
        }

        $sketchs = $datas['sketchs'];
        foreach($sketchs as $sketch)
        {
            $media = new Media();
            $media->postcard_id = $card->id;
            $media->url = $sketch['data'];
            $media->description = $sketch['description'];
            $media->type = 4;
            $media->save();
        }

        $images = $datas['images'];
        foreach($images as $image)
        {
            $media = new Media();
            $media->postcard_id = $card->id;
            $media->description = $image['description'];
            $media->type = 1;
            $file = base64_decode($image['data']);
            $uuid = Uuid::generate(4);
            $fileName = $uuid . '.jpg';
            $media->url = $fileName;
            $media->save();
            Storage::disk('public')->put('images/' . $fileName, $file);
        }
        DB::commit();

        $card->medias;
        return response()->json(
            [
            'message' => 'La carte postale à bien été ajouté',
            'data' => $card
        ], 201, [],JSON_NUMERIC_CHECK);
    }
}
