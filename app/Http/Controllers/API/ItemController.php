<?php
 
 namespace App\Http\Controllers\API;
 
 use App\Models\ItemModel;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 class ItemController extends Controller
{
      /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function getItemById(Request $request)
    {
   
        // $this->validate($request, [
        //     'title' => 'required'
           
        // ]);

        $id = $request->id;

        $item = ItemModel::where('id', '=', $id)->paginate(10);
        return response()->json(['list' => $item], 200);
    }
}