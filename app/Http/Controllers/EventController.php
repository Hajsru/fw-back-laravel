<?php

namespace App\Http\Controllers;

use App\Event;

class EventController extends Controller
{
    public function index() {
        $events = Event::all();

        $eventResponse = [];

        $eventResponse['links']['self'] = url('/api/v1/events');
        $eventResponse['data'] = [];

        foreach ($events as $event) {
            array_push($eventResponse['data'], [
                'eventId' => $event->event_id,
                'name' => $event->name,
                'description' => $event->description,
                'eventDate' => $event->event_date,
                'placeName' => $event->place_name,
                'placePicture' => $event->place_picture
            ]);
        }

        return response()->json($eventResponse);
    }

    public function detail(string $id) {
        $event = Event::find($id);

        $eventResponse = [];

        $eventResponse['links']['self'] = url('/api/v1/events/'.$id);
        $eventResponse['links']['list'] = url('/api/v1/events');
        $eventResponse['data'] = [
                'eventId' => $event->event_id,
                'name' => $event->name,
                'description' => $event->description,
                'eventDate' => $event->event_date,
                'placeName' => $event->place_name,
                'placePicture' => $event->place_picture
            ];

        return response()->json($eventResponse);
    }

    public function comments(string $id) {
        $comments = Event::find($id)->comments;

        $eventResponse = [];

        $eventResponse['links']['self'] = url('/api/v1/events/'.$id.'/comments');
        $eventResponse['links']['parent'] = url('/api/v1/events/'.$id);

        $eventResponse['data'] = [];

        foreach ($comments as $comment) {
            array_push($eventResponse['data'], [
                'commentId' => $comment->comment_id,
                'commentText' => $comment->comment_text
            ]);
        }

        return response()->json($eventResponse);
    }

    public function rating(string $id) {
        $rating = Event::find($id)->ratings->avg('rating_value');

        $eventResponse = [];

        $eventResponse['links']['self'] = url('/api/v1/events/'.$id.'/rating');
        $eventResponse['links']['parent'] = url('/api/v1/events/'.$id);

        $eventResponse['data'] = [
            'rating' => $rating
        ];

        return response()->json($eventResponse);
    }

    public function speakers(string $id) {

        \DB::listen(function($sql) {
            \Log::debug($sql->sql);
        });

        $speakers = Event::find($id)->speakers;

        $eventResponse = [];

        $eventResponse['links']['self'] = url('/api/v1/events/'.$id.'/speakers');
        $eventResponse['links']['parent'] = url('/api/v1/events/'.$id);

        $eventResponse['data'] = [];

        foreach ($speakers as $speaker) {
            array_push($eventResponse['data'], [
                'speakerId' => $speaker->speaker_id,
                'name' => $speaker->name,
                'description' => $speaker->description,
                'photo' => $speaker->photo
            ]);
        }

        return response()->json($eventResponse);
    }
}
