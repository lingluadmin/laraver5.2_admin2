<?php

namespace App\Http\Middleware;

use App\Logics\BaseLogic;
use Closure;

class ApiAuth
{

    private $config = '';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        \Log::info('API_REQUEST', ['data' => $request->input('data'), 'sign' => $request->input('sign')]);

        $this->config = \Config::get('security');

        if( $this->config['on'] ){

            $data = $request->input('data');

            $sign = $request->input('sign');

            $this->checkSign($data, $sign);

        }

        return $next($request);
    }

    /**
     * @param $data
     * @param $sign
     * @desc 验证签名
     */
    public function checkSign($data, $sign){

        $this->checkEmpty($data, $sign);

        $this->checkSecurity($data, $sign);

    }

    /**
     * @param array $data
     * @param array $sign
     * @return \Illuminate\Http\JsonResponse
     * @desc 验证是否为空
     */
    private function checkEmpty($data=[], $sign=[]){

        if(empty($data) || empty($sign)){

            return json_encode(BaseLogic::callError('数据不能为空'));

        }

    }

    /**
     * @param array $data
     * @param $sign
     * @return \Illuminate\Http\JsonResponse
     * @desc 检测签名是否有误
     */
    private function checkSecurity($data=[], $sign){

        $securityKey = $this->config['api_auth_key'];

        ksort($data);

        $dataStr =  (string)json_encode($data);

        if( $sign !== md5($dataStr.$securityKey) ){

            return  json_encode(BaseLogic::callError('签名错误'));

        }

    }


}
