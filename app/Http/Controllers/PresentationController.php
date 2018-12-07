<?php

namespace App\Http\Controllers;

use App\Presentation;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function index() {
        $presentations = Presentation::select(['*', \DB::raw('array_to_json(images) as images_array')])->get();


        $presentationResponse = [];

        $presentationResponse['links']['self'] = url('/api/v1/presentations');
        $presentationResponse['data'] = [];

        foreach ($presentations as $presentation) {
            array_push($presentationResponse['data'], [
                'presentationId' => $presentation->event_id,
                'name' => $presentation->name,
                'description' => $presentation->description,
                'images' => json_decode($presentation->images_array)
            ]);
        }

        return response()->json($presentationResponse);
    }

    public function detail(string $id) {
        $presentation = Presentation::select(['*', \DB::raw('array_to_json(images) as images_array')])->find($id);

        $presentationResponse = [];

        $presentationResponse['links']['self'] = url('/api/v1/presentations/'.$id);
        $presentationResponse['links']['list'] = url('/api/v1/presentations');
        $presentationResponse['data'] = [
            'presentationId' => $presentation->event_id,
            'name' => $presentation->name,
            'description' => $presentation->description,
            'images' => json_decode($presentation->images_array)
        ];

        return response()->json($presentationResponse);
    }

    public function comments(string $id) {
        $comments = Presentation::find($id)->comments;

        $presentationResponse = [];

        $presentationResponse['links']['self'] = url('/api/v1/presentations/'.$id.'/comments');
        $presentationResponse['links']['parent'] = url('/api/v1/presentations/'.$id);

        $presentationResponse['data'] = [];

        foreach ($comments as $comment) {
            array_push($presentationResponse['data'], [
                'commentId' => $comment->comment_id,
                'commentText' => $comment->comment_text
            ]);
        }

        return response()->json($presentationResponse);
    }

    public function rating(string $id) {
        $rating = Presentation::find($id)->ratings->avg('rating_value');

        $presentationResponse = [];

        $presentationResponse['links']['self'] = url('/api/v1/presentations/'.$id.'/rating');
        $presentationResponse['links']['parent'] = url('/api/v1/presentations/'.$id);

        $presentationResponse['data'] = [
            'rating' => $rating
        ];

        return response()->json($presentationResponse);
    }
}
