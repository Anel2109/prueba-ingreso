<?php

namespace App\Observers;

use App\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $status = false;
        $result = null;
        DB::beginTransaction();
        try {
            $actionlog = new Order;
            $actionlog->comment = 'Se creo una orden';
            $actionlog->order_id = $order->id;
            $actionlog->process = 'create';
            $actionlog->save();

            $status = true;
            DB::commit();
        } catch (\Throwable $th) {
            $result = $th->getMessage();
            DB::rollback();
        }if($status){
            $salida = ['code' => 200, 'data' => $actionlog ];
            return $salida;
        }else{
            $salida = ['code' => 500, 'data' => $result ];
            return $salida;
        }
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
