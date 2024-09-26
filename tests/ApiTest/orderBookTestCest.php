<?php


namespace Tests\ApiTest;

use Tests\Support\ApiTestTester;

class orderBookTestCest
{
    public function _before(ApiTestTester $I)
    {
        $I->amBearerAuthenticated('e28c0bf0a1e8e3fef932b54ae35d654b7705a32ce3fed12784c6671378898bf0');

    }

    // tests
    public function submitAnOrder(ApiTestTester $I)
    {
        $I->sendPostAsJson('/orders',[ "bookId"=> 3, "customerName"=> "John"]);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "created"=> "boolean",
            "orderId"=> "string"
        ]);
    }
    public function getAllOrders(ApiTestTester $I){
        $I->sendGetAsJson('/orders');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "id"=> "string",
            "bookId"=> "integer",
            "createdBy"=> "string",
            "quantity"=> "integer",
            "timestamp"=> "integer"
        ]);
        }
   
    public function updateAnOrder(ApiTestTester $I){
        $I->sendPatch('/orders/WAuqHfY6vfjEVSXrAS4ad',  ["customerName"=> "leila claire" ]);
         $I->seeResponseCodeIs(204);
         
    }
    
    public function getAnOrder(ApiTestTester $I){
        // $I->sendGetAsJson('/orders/:id',[ "id"=>"2G69nG810b34zOt1j1Abd"]);
        $I->sendGetAsJson('/orders/WAuqHfY6vfjEVSXrAS4ad');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            "id"=> "WAuqHfY6vfjEVSXrAS4ad",
            "bookId"=> 3,
            // "customerName"=> "leila claire",
            "createdBy"=> "309a285515598499d154a21780c3312e61ece35576c0d205aa5de7cd3460f585",
            "quantity"=> 1,
            'timestamp' => 1726754484548
        ]);
    }
    public function deleteAnOrder(ApiTestTester $I){
        $I->sendDelete('/orders/WAuqHfY6vfjEVSXrAS4ad');
         $I->seeResponseCodeIs(204);
    }
    public function reDeleteAnOrder(ApiTestTester $I){
        $I->sendDelete('/orders/WAuqHfY6vfjEVSXrAS4ad');
         $I->seeResponseCodeIs(404);
         $I->seeResponseIsJson();
         $I->seeResponseContainsJson(["error"=> "No order with id WAuqHfY6vfjEVSXrAS4ad."]);
    }
}
