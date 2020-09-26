<?php
 
 namespace App\Http\Controllers\API;
 
 use App\Models\OrderModel;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 class OrderController extends Controller
{
      /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */


    public function getOrderById(Request $request)
    {
   
        // $this->validate($request, [
        //     'title' => 'required'
           
        // ]);

        $id = $request->id;

        $order = OrderModel::where('id', '=', $id)->paginate(10);
        return response()->json(['list' => $order], 200);
    }
}