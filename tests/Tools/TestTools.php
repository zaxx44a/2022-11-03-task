<?php


namespace Tests\Tools;

use App\Models\Order;
use App\Models\OrderAdjustment;
use App\Models\OrderPayment;
use App\Models\OrderPurchase;
use App\Models\OrderShipment;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Passport;

trait TestTools
{
    public function authenticate($email = 'test@example.com',$password = 'password')
    {
        $response = $this->postJson(route('login', [
            'email' => $email,
            'password' => $password,
        ]));

        $auth = json_decode($response->getContent());
        if($response->getContent() == 200){
            $this->withHeaders([
                'Authorization' => 'Bearer ' . $auth->access_token,
                'Accept' => 'application/json'
            ]);
        }
        return $response;
    }
}
