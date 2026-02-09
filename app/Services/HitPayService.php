<?php 

namespace App\Services;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class HitPayService{
    private string $apiKey;
    private string $apiUrl;
    private ?string $lastPaymentRequestId = null;

    public function __construct(){
        // $this->apiKey = env('HITPAY_API_KEY', '');
        // $this->salt = env('HITPAY_SALT', '');
        $this->apiKey = config('services.hitpay.api_key') ?? '';
        $this->apiUrl = config('services.hitpay.sandbox', true) ? 'https://api.sandbox.hit-pay.com/v1' : 'https://api.hit-pay.com/v1';
    }
    
    public function createPaymentRequest(Order $order): ?string{
        if(empty($this->apiKey)){
            Log::error('Hitpay Api is not configured');

        }
        try{
            $http = Http::withHeaders([
                'X-BUSINESS-API-KEY' =>$this->apiKey,
                'Content-Type' => 'application/x-www-form-urlencoded',

            ]);
            if(config('services.hitpay.sandbox', true)){
                $http = $http->withoutVerifying();
            }
            $payload = [
                'amount' => number_format($order->total, 2,'.',''),
                'currency' =>$order->currency,
                'email' => $order->guest_email,
                'name' => $order->guest_name,
                'purpose' => 'Order #'. $order->order_number,
                'reference_number' => $order->order_number,
                'redirect_url' => route('checkout.success', ['reference' =>$order->order_number]),
                'redirect_url_fail' => route('checkout.failed', ['reference' =>$order->order_number]),

                'allow_repeated_payments' => false,
            ];
            $webhookUrl = route('webhook.hitpay');
            if(!str_contains($webhookUrl, 'localhost') && !str_contains($webhookUrl, '127.0.0.1')){
                $payload['webhook'] = $webhookUrl;
            }

            Log::info('HitPay request payload: ' . json_encode($payload));

            $response = $http->asForm()->post($this->apiUrl. '/payment-requests', $payload);

            Log::info('HitPay response status: ' .$response->status());
            Log::info('HitPay response status body: ' .$response->body());

            if($response->successful()){
                $data= $response->json();
                $this->lastPaymentRequestId = $data['id'] ?? null;
                $url= $data['url'] ?? null;
                Log::info('HitPay payment Url :' .$url);
                return $url;
            }
            Log::error('HitPay API error :'.$response->body());
            return null;
        }catch(\Exception $e){
            Log::error('Hitpay Api exception'. $e->getMessage());
            return null;
        }
    }
    public function getLastPaymentRequestId(): ?string{
        return $this->lastPaymentRequestId;
    }

    public function verifyWebhook(array $payload, string $signature): bool{
        
        $salt= config('services.hitpay.salt', '');

        if(empty($salt)){
            Log::warning('HitPay webhook salt is not configured');
            return false;
        }
        $data = $payload;
        unset($data['hmac']);

        ksort($data);

        $dataString = '';
        foreach($data as $key => $value){
            if(is_array($value)){
                continue;
            }
            $dataString .= $key.$value;
        }

        $calculateSignature = hash_hmac('sha256', $dataString, $salt);
        return hash_equals($calculateSignature, $signature);
    }
}