<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CanceledOrderDataTable;
use App\DataTables\DeliveredOrderDataTable;
use App\DataTables\DroppedOffOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\OutForDeliveryOrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\ProcessedOrderDataTable;
use App\DataTables\ShippedOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    public function pendingOrders(PendingOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.pending-order');
    }

    public function processedOrders(ProcessedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.pending-order');
    }

    public function droppedOfOrders(DroppedOffOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.dropped-off-order');
    }

    public function shippedOrders(ShippedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.shipped-order');
    }

    public function outForDeliveryOrders(OutForDeliveryOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.out-for-delivery-order');
    }

    public function deliveredOrders(DeliveredOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.delivered-order');
    }

    public function canceledOrders(CanceledOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.canceled-order');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // delete order products
        $order->orderProducts()->delete();
        // delete transaction
        $order->transaction()->delete();

        $order->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    /**
     * Change order status.
     */
    public function changeOrderStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->order_status = $request->status;
        $order->save();

        return response(['status' => 'success', 'message' => 'Updated Order Status']);
    }

    /**
     * Change Payment order status.
     */
    public function changePaymentOrderStatus(Request $request)
    {
        $paymentStatus = Order::findOrFail($request->id);
        $paymentStatus->Payment_status = $request->status;
        $paymentStatus->save();

        return response(['status' => 'success', 'message' => 'Updated Payment Status Successfully']);
    }
}
