<?php 

namespace App\Http\Traits;

trait ApiResponseTrait{

    /**
     * Success response method. All went well, and (usually) some data was returned.
     * 
     * @param $result
     * @param string $data
     * @param int $code
     * @param array $headers
     *
     * @return JsonResponse
     */
    public function sendResponse($data, $message = "", $code = 200, $headers = [])
    {
        $response = [
            'status' => "success",
            'message' => $message,
            'data' => $data,
        ];

        return response($response, $code, $headers);
    }

    /**
     * Fail response method. There was a problem with the data submitted, or some pre-condition of the API call wasn't satisfied.
     *
     * @param $query
     * @param string $message
     * @param int $code
     * @param array $headers
     *
     * @return JsonResponse
     */
    public function sendFail($query, $message = "", $code = 400, $headers = [])
    {
        $data["query"] = $query;
        $response = [
            'status' => "fail",
            'message' => $message,
            'data' => $data,
        ];

        return response($response, $code, $headers);
    }

    /**
     * Return error response. An error occurred in processing the request, i.e. an exception was thrown.
     *
     * @param string $message
     * @param int  $code
     * @param array $headers
     *
     * @return JsonResponse
     */
    public function sendError($message = "", $code = 500, $headers = [])
    {
        $response = [
            'status' => "error",
            'message' => $message,
        ];

        return response($response, $code, $headers);
    }
}
