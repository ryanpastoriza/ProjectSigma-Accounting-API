<?php

namespace App\Guards;

use App\Models\User;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum;
use Illuminate\Support\Facades\Log;

class AuthTokenGuard implements Guard
{
    use GuardHelpers;

    protected $request;
    protected $hrmsApiUrl;

    public function __construct(Request $request)
    {
        $this->hrmsApiUrl = config()->get('services.url.hrms_api_url');
        $this->request = $request;
    }

    public function user()
    {
        if ($this->user !== null) {
            return $this->user;
        }
		
        $token = $this->request->bearerToken();
        $response = Http::withToken($token)
            ->acceptJson()
            ->get($this->hrmsApiUrl . '/api/session');
        if (!$response->successful()) {
            return null;
        }

        if ($response->json()) {
            $this->user = new User();
            $this->user->id = $response->json()['id'];
            $this->user->name = $response->json()['name'];
            $this->user->email = $response->json()['email'];
            $this->user->type = $response->json()['type'];
            $this->user->accessibilities = $response->json()['accessibilities'];
            $this->user->accessibilities_name = $response->json()['accessibility_names'];
            $this->user->employee = $response->json()['employee'];
        }
        return $this->user;
    }
    public function validate(array $credentials = []){}
}
