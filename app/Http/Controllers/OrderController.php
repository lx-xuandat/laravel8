<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use \Illuminate\Http\Request;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\Log;
class OrderController extends Controller
{
    public const stDungBan = 0;
    public const msgDungBan = 'Mat Hang Nay Dang Tam Dung Kinh Doanh';

    public const success = 1;
    public const msgSuccess = 'Them Vao Gio Hang Thanh Cong';

    public const stHetHang = 2;
    public const msgHetHang = 'Mat Hang Nay Dang Tam Het';

    public const stThieuHang = 21;
    public const msgThieuHang = 'So Luong Hang Yeu Cau Khong Du';



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Kiem Tra Cac Thong Tin Co Ban
        $customerID = auth()->id();
        $input = $request->only([ // request customer
            'product_id',
            'quantity',
        ]);

        // product by Bought
        $product = Product::where('id', $input['product_id'])
            ->where('quantity', '>=', $input['quantity'])
            ->where('status', 1)
            ->first();

        if (!$product) {
            return response()->json([
                'status' => self::stHetHang,
                'message' => self::msgHetHang,
            ]);
        }

        // 2. lay thong tin dat hang cua khach
        $order = Order::where('user_id', $customerID)->where('status', 1)->first();
        // 2.1 tao gio hang cho khach
        if (!$order) {
            $order = [
                'code' => 'ogn_' . now()->format('YmdHis') . '_' . $customerID,
                'user_id' => $customerID,
                'address' => 'Hoang Mai, Ha Noi',
            ];
            try {
                $order = Order::create($order);
            } catch (\Throwable $th) { // phien ban cu sd exception
                Log::info('create order failed');
                Log::info($th);
            }
        }

        // 3. lay thong tin chi tiet cua product trong order
        $item = ProductOrder::where('product_id', $input['product_id'])
            ->where('order_id', $order->id)->first();

        // 3.1 Kiem Tra hang ton kho va Then hang vao gio
        if (!$item) {
            try {
                $item = ProductOrder::create([
                    'product_id' => $input['product_id'],
                    'order_id' => $order->id,
                    'quantity' => $input['quantity'],
                    'price' => $product->price,
                ]);
            } catch (\Throwable $th) {
                Log::info('create ProductOrder failed');
                Log::info($th);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Da Them Vao Gio Hang',
                $item,
                $order,
            ]);
        }

        // 3.2 Kiem Tra hang ton kho va Cap nhat so luong hang trong gio
        $item->quantity += $input['quantity'];
        if ($product->quantity < $item->quantity) {
            return response()->json([
                'status' => self::stHetHang,
                'message' => self::msgHetHang,
            ]);
        }
        $item->save();
        return response()->json([
            'status' => self::success,
            'message' => self::msgSuccess,
            $item,
            $order,
        ]);
    }
}
