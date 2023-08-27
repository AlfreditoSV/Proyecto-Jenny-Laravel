<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use App\Models\Logs;
use Illuminate\Http\Request;
use App\Traits\App;
use Exception;

class LogsController extends Controller
{
    use App;

    /**
     * Author: Alfredo Segura Vara <pixxo2010@gmail.com>
     * Description: Register the action in the logs table
     * Date: 2023-08-23
     * @param array $data
     */
    static function register(array $data)
    {
        try {
            $data=[
                'id_user' => auth()->user()->id,
                'data_log' => json_encode($data),
                'created_at' => self::getCurrentTime()
            ];
            Logs::insert($data);            
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
