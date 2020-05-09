<?php

namespace App\Http\Controllers;

use App\City;
use App\Mail\OrderMail;
use App\Order;
use App\Product;
use App\ProductsOrder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function getOrders()
    {
        $orders = Order::with('user', 'city', 'status')->get();
        return $this->response(true, ['type' => 'success', 'content' => 'Obtuvimos resultados'], $orders);
    }

    public function getUsers()
    {
        return $this->response(true, ['type' => 'success', 'content' => 'Obtuvimos Resultados'], User::all());
    }

    public function getCities()
    {
        return $this->response(true, ['type' => 'success', 'content' => 'Obtuvimos Resultados'], City::all());
    }

    public function getProducts()
    {
        return $this->response(true, ['type' => 'success', 'content' => 'Obtuvimos Resultado'], Product::all());
    }

    public function saveOrder(Request $request){
        $status = false;
        $result = null;
        DB::beginTransaction();
        try {
            $order = new Order;
            $order->user_id = $request->user;
            $order->total = $request->total;
            $order->city_id = $request->city;
            $order->status_id = 3;
            $order->comments = 'dejar en porteria';
            $order->tax = $request->tax;
            $order->subtotal = $request->subtotal;
            $order->shipping_value = $request->shipping_value;
            $order->time_zone_id = 1;
            $order->save();

            $products = json_decode($request->products);

            foreach($products as $key => $value){
                // return $value;
                $productsOrder = new ProductsOrder();
                $productsOrder->order_id = $order->id;
                $productsOrder->product_id = $value->product->id;
                $productsOrder->save();
            }

            $user = User::where('id', $request->user)->select('email')->get();


            Mail::to($user)->send(new OrderMail($order));

            $status = true;
            DB::commit();
        } catch (\Throwable $th) {
            $result = $th->getMessage();
            DB::rollback();
        }if($status){
            $salida = ['code' => 200, 'data' => $order];
            return $salida;
        }else{
            $salida = ['code' => 500, 'data' => $result];
            return $salida;
        }
    }
}
