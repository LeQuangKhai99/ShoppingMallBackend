<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $order;
    public function __construct(Order $order){
        $this->order = $order;
    }

    public function index(){
        $orders = $this->order->latest()->paginate(5);
        return view('admin.order.index', ['orders'=>$orders]);
    }

    public function detail($id){
        $order = $this->order->find($id);
        return view('admin.order.detail', ['order'=>$order]);
    }

    public function delete($id){
        try {
            $this->order->find($id)->delete();
            return response()->json([
                'code'=>200,
                'mess'=>'success'
            ], 200);
        }catch (\Exception $exception){
            return response()->json([
                'code'=>500,
                'mess'=>'err'
            ], 500);
        }
    }

    public function edit($id){
        try {
            $order = $this->order->find($id);

            $order->update([
                'status'=> 1-$order->status
            ]);
            return response()->json([
                'code'=>200,
                'mess'=>1-$order->status
            ], 200);
        }catch (\Exception $exception){
            return response()->json([
                'code'=>500,
                'mess'=>'err'
            ], 500);
        }
    }
}
