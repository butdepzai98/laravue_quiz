<!------------------- Transaction ------------------>

<!-- 
    DB::transaction is used when you query for 2 or more Table
        if(there is an error method)
            the query will be recall (thu hồi)
 -->

use Illuminate\Support\Facades\DB;

-------------------------
try {
    DB::beginTransaction();

    //...query...//

    DB::commit();

    return response()->json([
        'status'    => true,
        'code'  => Response::HTTP_OK
    ]);
} catch (\Exception $e) {

    DB::rollback();

    return response()->json([
        'errors'    => [
            'status'    => false,
            'code'      => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message'   => $e->getMessage(),
        ]
    ]);
}
-------------------------