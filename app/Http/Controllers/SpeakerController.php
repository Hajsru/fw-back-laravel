<?php

namespace App\Http\Controllers;

use App\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function index() {
        $speakers = Speaker::all();

        $speakerResponse = [];

        $speakerResponse['links']['self'] = url('/api/v1/speakers');
        $speakerResponse['data'] = [];

        foreach ($speakers as $speaker) {
            array_push($speakerResponse['data'], [
                'speakerId' => $speaker->speaker_id,
                'name' => $speaker->name,
                'description' => $speaker->description,
                'photo' => $speaker->photo
            ]);
        }

        return response()->json($speakerResponse);
    }

    public function detail(string $id) {
        $speaker = Speaker::find($id);

        $speakerResponse = [];

        $speakerResponse['links']['self'] = url('/api/v1/speakers/'.$id);
        $speakerResponse['links']['list'] = url('/api/v1/speakers');
        $speakerResponse['data'] = [
            'speakerId' => $speaker->speaker_id,
            'name' => $speaker->name,
            'description' => $speaker->description,
            'photo' => $speaker->photo
        ];

        return response()->json($speakerResponse);
    }

    public function comments(string $id) {
        $comments = Speaker::find($id)->comments;

        $speakerResponse = [];

        $speakerResponse['links']['self'] = url('/api/v1/speakers/'.$id.'/comments');
        $speakerResponse['links']['parent'] = url('/api/v1/speakers/'.$id);

        $speakerResponse['data'] = [];

        foreach ($comments as $comment) {
            array_push($speakerResponse['data'], [
                'commentId' => $comment->comment_id,
                'commentText' => $comment->comment_text
            ]);
        }

        return response()->json($speakerResponse);
    }

    public function rating(string $id) {
        $rating = Speaker::find($id)->ratings->avg('rating_value');

        $speakerResponse = [];

        $speakerResponse['links']['self'] = url('/api/v1/speakers/'.$id.'/rating');
        $speakerResponse['links']['parent'] = url('/api/v1/speakers/'.$id);

        $speakerResponse['data'] = [
            'rating' => $rating
        ];

        return response()->json($speakerResponse);
    }
}
