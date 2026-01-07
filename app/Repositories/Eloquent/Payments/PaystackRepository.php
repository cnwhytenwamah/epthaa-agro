<?php

namespace App\Repositories\Eloquent\Payments;

use stdClass;

use App\Repositories\ApiClients\ClientApi;
use StephenAsare\Paystack\Facades\Paystack;
use StephenAsare\Paystack\Exceptions\PaystackException;
use App\Repositories\Interface\PaymentRepositoryInterface;

class PaystackRepository extends ClientApi implements PaymentRepositoryInterface
{
    /**
     * Create a new class instance.
     */

    public function __construct()
    {
        $this->config = (object) config('services.paystack');
        $this->headers = [
            "Authorization: Bearer " . $this->config->secret_key,
            "Cache-Control: no-cache",
        ];
    }

    public function initialize(object $data): stdClass
    {
        $fields = [
            'email' => $data->customer_email,
            'amount' => $data->total * 100,
            'reference' => $data->payment_reference,
            'callback_url' => route('checkout.payment.verify', $data->payment_reference)
        ];
        
        $data = http_build_query($fields);
        $uri = "transaction/initialize";
        try{
            $response = $this->post($uri, $data);
            // $response = Paystack::transaction()->initialize($fields);
            dd($response);

            //check if process was successful
            if ($response['data']['status'] === 'success' && isset($response['data']['authorization_url'])) {
                return (object)[
                    'status' => true,
                    'message' => 'payment initiated successfully',
                    'url' => $response['data']['authorization_url']
                ];
            }
            return (object)['status' => false, 'message' => '', 'url' => null];
        }catch(Exception $e){
            dd($e->getMessage());
            return (object)['status' => false, 'message' => $e->getMessage(), 'url' => null];
        }
    }

    public function verify(string $reference, int $amount): bool
    {
        $response = paystack()->transaction()->verify($reference);
        if ($response['data']['status'] === 'success') {
            if ($response['data']['amount'] === $amount) {
                return true;
            }
        }
        return false;
    }

    public function refund(string $reference, ?int $amount = null): stdClass
    {
        $url = $this->config->base_url . '/refund';

        $payload = array_filter([
            'reference' => $reference,
            'amount' => $amount,
        ]);

        return $this->post($url, $payload);
    }
}

