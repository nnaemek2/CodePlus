<?php

namespace App\Http\Controllers\Api;

use App\Constants\Status;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use Illuminate\Support\Facades\Validator;

class InstallationController extends Controller
{
    public function verifyPurchasedCode(Request $request)
    {
        $headerData = $request->header();

        $apiKey = ApiKey::where('key', @$headerData['apikey'])->where('status', Status::ACTIVE_KEY)->first();

        if (!$apiKey) {
            $message[] = 'Invalid api key';
            return response()->json([
                'status'      => 'error',
                'status_code' => '401',
                'message'     => ['error' => $message]
            ]);
        }

        $validator = Validator::make($request->all(), [
            'purchase_code' => 'required|size:23|exists:order_items,purchase_code'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'      => 'error',
                'status_code' => '422',
                'message'     => ['error' => $validator->errors()->all()],
            ]);
        }

        $item = OrderItem::where('purchase_code', $request->purchase_code)->whereHas('product', function ($q) use ($apiKey) {
            $q->whereHas("author", function ($productQuery) use ($apiKey) {
                $productQuery->where('user_id', $apiKey->user_id)->where('is_author', Status::YES)->active();
            });
        })->first();

        if ($item) {
            $notify[] = 'Purchase code matched';
            return response()->json([
                'status'      => 'success',
                'status_code' => '200',
                'message'     => ['success' => $notify]
            ]);
        } else {
            $notify[] = "Purchase code doesn't matched";
            return response()->json([
                'status'      => 'error',
                'status_code' => '500',
                'message'     => ['error' => $notify]
            ]);
        }
    }
}
