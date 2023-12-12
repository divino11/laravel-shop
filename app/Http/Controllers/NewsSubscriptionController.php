<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsSubscriptionRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class NewsSubscriptionController extends Controller
{
    public function __invoke(NewsSubscriptionRequest $request): JsonResponse
    {
        $data = $request->validated();

        DB::table('news_subscription')->insert([
            'email' => $data['email'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Вы успешно подписались на email рассылку!'
        ]);
    }
}
