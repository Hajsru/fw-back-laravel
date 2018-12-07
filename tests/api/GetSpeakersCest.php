<?php

use Codeception\Util\HttpCode;

class GetSpeakersCest
{
    public function _before(ApiTester $I)
    {
    }

    public function getSpeakerList(ApiTester $I)
    {
        $I->sendGET('/speakers');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'links' => [
                'self' => 'http://localhost/api/v1/speakers'
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

    public function getSpeaker(ApiTester $I)
    {
        $I->sendGET('/speakers/1');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'links' => [
                'self' => 'http://localhost/api/v1/speakers/1',
                'list' => 'http://localhost/api/v1/speakers'
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

    public function getSpeakerComments(ApiTester $I)
    {
        $I->sendGET('/speakers/1/comments');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'links' => [
                'parent' => 'http://localhost/api/v1/speakers/1',
                'self' => 'http://localhost/api/v1/speakers/1/comments'
            ]
        ]);

        $I->seeResponseContainsJson([
            'data' => [
                'commentId' => 3,
                'commentText' => 'Какой обаяшка!'
            ]
        ]);
    }

    public function getSpeakerRating(ApiTester $I)
    {
        $I->sendGET('/speakers/1/rating');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'links' => [
                'parent' => 'http://localhost/api/v1/speakers/1',
                'self' => 'http://localhost/api/v1/speakers/1/rating'
            ]
        ]);

        $I->seeResponseContainsJson([
            'data' => [
                'rating' => '4'
            ]
        ]);
    }
}
