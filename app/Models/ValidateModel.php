<?php
/**
 * User: zhangshuang
 * Date: 16/4/19
 * Time: 10:39
 * Desc: 数据统一验证Model
 */
namespace App\Models;
use App\Lang\LangModel;

class ValidateModel extends BaseModel{

    
    public static $codeArr = [
        'isNumber'                          => 1,
        'isCash'                            => 2,
        'isIntCash'                         => 3,
        'isDecimalCash'                     => 4,
        'isBankCard'                        => 5,
        'isName'                            => 6,
        'isIdCard'                          => 7,
        'isRate'                            => 8,
        'isPhone'                           => 9,
        'isSmsCode'                         => 10,
        'isEmail'                           => 11,

    ];

    public static $expNameSpace = ExceptionCodeModel::EXP_MODEL_BASE;


    /**
     * @param $cash
     * @throws Exception
     * 判断金额是否正确
     */
    public static function isInt($cash = 0){

        $pattern        = '/^\d+$/';

        if(!preg_match($pattern, $cash) || 0 === (int)$cash) {

            throw new \Exception(LangModel::getLang('ERROR_COMMON'), self::getFinalCode('isIntCash'));

        }

        return true;

    }

    /**
     * @param $cash
     * @return bool
     * @throws \Exception
     * 可以为小数金额
     */
    public static function isDecimal($cash){
        $pattern        = '/^[0-9]+([.][0-9]{1,2})?$/';
        if(!preg_match($pattern, $cash) || $cash < 0.01) {
            throw new \Exception(LangModel::getLang('ERROR_COMMON'), self::getFinalCode('isDecimalCash'));
        }
        return true;
    }

    /**
     * @param string $cardNo
     * @throws \Exception
     * 判断银行卡号是否合法
     */
    public static function isBankCard($cardNo = ''){

        $len = strlen($cardNo);

        if(!($len == 16 || $len == 17 || $len == 19 || preg_match('#^\d{18}$#', $cardNo))){

            throw new \Exception(LangModel::getLang('ERROR_COMMON'), self::getFinalCode('isBankCard'));
        }

        return true;

    }


    /**
     * 姓名格式校验
     * @param $name
     */
    public static function isName($name) {

        if(preg_match('#[a-z\d~!@\#$%^&*()_+{}|\[\]\-=:<>?/"\'\\\\]#', $name)) {

            throw new \Exception(LangModel::getLang('ERROR_COMMON'), self::getFinalCode('isName'));
        }

        return true;

    }


    /**
     * @param $idCard
     * @return bool
     * 身份证格式判断
     */
    public static function isIdCard($idCard)
    {

        if(!preg_match('/^(\d{15}|\d{17}X|\d{18})$/i', $idCard)) {
            $res = false;
        } else if(strlen($idCard) == 18) {
            $res     = self::idcard_checksum18($idCard);
        } else if((strlen($idCard) == 15)) {
            $idCard = self::idcard_15to18($idCard);
            $res     = self::idcard_checksum18($idCard);
        } else {
            $res     = false;
        }

        if(empty($res)) {

            throw new \Exception(LangModel::getLang('ERROR_COMMON'), self::getFinalCode('isIdCard'));
        }else{
            /*if(!self::checkAgeByIDCard($idCard)){

                throw new \Exception(LangModel::getLang('ERROR_COMMON'), self::getFinalCode('isIdCardCheckAgeByIDCard'));
            }*/
        }

        return true;
    }

    /**
     * @param $IDCard
     * @return bool
     * 判断用户是否已年满十八岁
     */
    private static function checkAgeByIDCard($IDCard){

        if(strlen($IDCard)==18){

            $tyear = (int)substr($IDCard,6,4);

            $tmonth = (int)substr($IDCard,10,2);

            $tday = (int)substr($IDCard,12,2);

        }elseif(strlen($IDCard)==15){

            $tyear = (int)("19".substr($IDCard,6,2));

            $tmonth = (int)substr($IDCard,8,2);

            $tday = (int)substr($IDCard,10,2);

        }

        $birthday = strtotime($tyear.'-'.$tmonth.'-'.$tday.' + 18 years');

        $today = time();

        if($today > $birthday){

            return true;

        }else{

            return false;

        }
    }


    // 计算身份证校验码，根据国家标准GB 11643-1999
    private static function idcard_verify_number($idcard_base)
    {
        if(strlen($idcard_base) != 17) {
            return false;
        }
        //加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        //校验码对应值
        $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        $checksum = 0;
        for ($i = 0; $i < strlen($idcard_base); $i++) {
            $checksum += substr($idcard_base, $i, 1) * $factor[$i];
        }
        $mod = $checksum % 11;
        $verify_number = $verify_number_list[$mod];
        return $verify_number;
    }

    // 将15位身份证升级到18位
    private static function idcard_15to18($idcard){
        if (strlen($idcard) != 15){
            return false;
        } else {
            // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
            if (array_search(substr($idcard, 12, 3), array('996', '997', '998', '999')) !== false){
                $idcard = substr($idcard, 0, 6) . '18'. substr($idcard, 6, 9);
            } else {
                $idcard = substr($idcard, 0, 6) . '19'. substr($idcard, 6, 9);
            }
        }
        $idcard = $idcard . self::idcard_verify_number($idcard);
        return $idcard;
    }

    // 18位身份证校验码有效性检查
    private static function idcard_checksum18($idcard){
        if (strlen($idcard) != 18){
            return false;
        }
        $idcard_base = substr($idcard, 0, 17);
        if (self::idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @param $rate
     * @return bool
     * @throws \Exception
     * 验证利率
     */
    public static function isRate($rate){
        $pattern        = '/^[1-9]+([.][0-9]+)?$/';
        if(!preg_match($pattern, $rate)) {
            throw new \Exception(LangModel::getLang('ERROR_COMMON'), self::getFinalCode('isRate'));
        }
        return true;
    }


    /**
     * @param string $phone
     * @throws \Exception
     * 判断是否是手效的手机号码
     */
    public static function isPhone($phone = ''){

        $pattern    = '/^(13\d|14[57]|15[012356789]|18\d|17[013678])\d{8}$/';
        if(!preg_match($pattern, $phone)) {

            throw new \Exception(LangModel::getLang('ERROR_COMMON'), self::getFinalCode('isPhone'));

        }

        return true;

    }

    /**
     * @param string $code
     * @throws \Exception
     * 验证短信验证码格式是否正确
     */
    public static function isSmsCode($code = ''){

        $pattern    = '/^\d{6}$/';
        if(!preg_match($pattern, $code)) {

            throw new \Exception(LangModel::getLang('ERROR_COMMON'), self::getFinalCode('isSmsCode'));

        }

        return true;
    }


    /**
     * @param $email
     * @return bool
     * @throws \Exception
     * 邮箱
     */
    public static function isEmail($email){

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            throw new \Exception(LangModel::getLang('ERROR_COMMON'), self::getFinalCode('isEmail'));

        }

        return true;

    }

    /**
     * @param $data
     * @return bool
     * @throws \Exception
     * 是否为空
     */
    public static function isEmpty( $data ){

        if( empty($data) ){

            throw new \Exception(LangModel::getLang('ERROR_IS_EMPTY'), self::getFinalCode('isEmpty'));

        }

        return true;

    }

}
