<?php


namespace Tests\ApiTest;

use Tests\Support\ApiTestTester;

class bookTestCest
{
    public function _before(ApiTestTester $I)
    {
    }

    // tests
    public function getApiStatus(ApiTestTester $I)
    {
        $I->sendGet('/status');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"status"=>"OK"}');

    }

    public function getAllBooks(ApiTestTester $I){
        $I->sendGet('/books',["type"=>"fiction"]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "id"=>"integer",
            "name"=>"string",
            "type"=>"string",
            "available"=>"boolean",
        ]);
    }
    public function getASingleBooks(ApiTestTester $I){

        $I->sendGet('/books/1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            "id"=> 1,
            "name"=> "The Russian",
            "author"=> "James Patterson and James O. Born",
            "isbn"=> "1780899475",
            "type"=> "fiction",
            "price"=> 12.98,
            "current-stock"=> 12,
            "available"=> true
        ]);

    }


}
