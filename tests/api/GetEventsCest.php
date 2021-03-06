<?php

use Codeception\Util\HttpCode;

class GetEventsCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function getEventList(ApiTester $I)
    {
        $I->sendGET('/events');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
           'links' => [
               'self' => 'http://localhost/api/v1/events'
           ]
        ]);

        $I->seeResponseContainsJson([
            'data' => [
                'eventId' => 1,
                'name' => 'Test event',
                'description' => 'Some test event',
                'eventDate'=> '2018-11-22',
                'placeName' => 'Place name',
                'placePicture' => '//static.hajs.ru/picture.jpg'
            ]
        ]);
    }

    public function getEvent(ApiTester $I)
    {
        $I->sendGET('/events/1');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'links' => [
                'self' => 'http://localhost/api/v1/events/1',
                'list' => 'http://localhost/api/v1/events'
            ]
        ]);

        $I->seeResponseContainsJson([
            'data' => [
                'eventId' => 1,
                'name' => 'Test event',
                'description' => 'Some test event',
                'eventDate'=> '2018-11-22',
                'placeName' => 'Place name',
                'placePicture' => '//static.hajs.ru/picture.jpg'
            ]
        ]);
    }

    public function getEventComments(ApiTester $I)
    {
        $I->sendGET('/events/1/comments');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'links' => [
                'parent' => 'http://localhost/api/v1/events/1',
                'self' => 'http://localhost/api/v1/events/1/comments'
            ]
        ]);

        $I->seeResponseContainsJson([
            'data' => [
                'commentId' => 1,
                'commentText' => 'Супер эвент - весгда бы так!'
            ]
        ]);
    }

    public function getEventRating(ApiTester $I)
    {
        $I->sendGET('/events/1/rating');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'links' => [
                'parent' => 'http://localhost/api/v1/events/1',
                'self' => 'http://localhost/api/v1/events/1/rating'
            ]
        ]);

        $I->seeResponseContainsJson([
            'data' => [
                'rating' => '2'
            ]
        ]);
    }

    public function getEventSpeakers(ApiTester $I)
    {
        $I->sendGET('/events/1/speakers');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'links' => [
                'parent' => 'http://localhost/api/v1/events/1',
                'self' => 'http://localhost/api/v1/events/1/speakers'
            ]
        ]);

        $I->seeResponseContainsJson([
            'data' => [
                "speakerId" => 1,
                "name" => "Чел Мордашкин",
                "photo" =>  "//static.hajs.ru/amazing_photo.jpg",
                "description"=> "Хороший человек с приятной внешностью"
            ]
        ]);
    }

    public function getEventPresentations(ApiTester $I)
    {
        $I->sendGET('/events/1/presentations');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'links' => [
                'parent' => 'http://localhost/api/v1/events/1',
                'self' => 'http://localhost/api/v1/events/1/presentations'
            ]
        ]);

        $I->seeResponseContainsJson([
            'data' => [
                "presentationId" => 1,
                "name" => "Как написать документацию и не сойти с ума",
                "images" => [
                    "//static.hajs.ru/amazing_photo.jpg"
                ],
                "description"=> "Больше никакой темы не приходит на ум"
            ]
        ]);
    }
}
