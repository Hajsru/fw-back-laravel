<?php

use Codeception\Util\HttpCode;

class GetPresentationsCest
{
    public function _before(ApiTester $I)
    {
    }

    public function getPresentationList(ApiTester $I)
    {
        $I->sendGET('/presentations');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'links' => [
                'self' => 'http://localhost/api/v1/presentations'
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

    public function getPresentation(ApiTester $I)
    {
        $I->sendGET('/presentations/1');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'links' => [
                'self' => 'http://localhost/api/v1/presentations/1',
                'list' => 'http://localhost/api/v1/presentations'
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

    public function getPresentationComments(ApiTester $I)
    {
        $I->sendGET('/presentations/1/comments');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'links' => [
                'parent' => 'http://localhost/api/v1/presentations/1',
                'self' => 'http://localhost/api/v1/presentations/1/comments'
            ]
        ]);

        $I->seeResponseContainsJson([
            'data' => [
                'commentId' => 2,
                'commentText' => 'Вот это темищщще!'
            ]
        ]);
    }

    public function getPresentationRating(ApiTester $I)
    {
        $I->sendGET('/presentations/1/rating');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'links' => [
                'parent' => 'http://localhost/api/v1/presentations/1',
                'self' => 'http://localhost/api/v1/presentations/1/rating'
            ]
        ]);

        $I->seeResponseContainsJson([
            'data' => [
                'rating' => '3'
            ]
        ]);
    }
}
