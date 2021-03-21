<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $code = JsonResponse::HTTP_OK)
    {
        $response = [
            'status' => $code,
            'message' => $message,
            'data' => $result,
        ];
        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error,$code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
    {
        $response = [
            'status' => $code,
            'message' => $error,
            'data' => (object) array(),
        ];
        return response()->json($response, JsonResponse::HTTP_CREATED);
    }

    /**
     * return __paginate response.
     *
     * @return \Illuminate\Http\Response
     */
    public function __paginate($resource, $data){
        return [
            'data'=>$resource,
            'pagination' => [
                'total' => $data->total(),
                'count' => $data->count(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'total_pages' => $data->lastPage()
            ]
        ];
    }
}
