<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/11/2
 * Time: 下午12:02
 * Desc: 公共查询条件类
 */

namespace App\Models;

class CommonScopeModel extends BaseModel{


    public function scopeId($query, $id){

        return $query->where('id', $id);

    }

    public function scopeIds($query, $ids){

        return $query->whereIn('id', $ids);

    }

    public function scopeUserId($query, $userId){

        return $query->where('user_id', $userId);

    }

    public function scopeUserIds($query, $userIds){

        return $query->whereIn('user_id', $userIds);

    }

    //身份证姓名
    public function scopeRealName($query, $realName){

        return $query->where('real_name', $realName);

    }

    //手机号
    public function scopePhone($query, $phone){

        return $query->where('phone', $phone);

    }

    //身份证号码
    public function scopeIdentityCard($query, $identityCard){

        return $query->where('identity_card', $identityCard);

    }

    //创建时间BetweenCreatedAt
    public function scopeBetweenCreatedAt($query, $startAt, $endAt){

        return $query->whereBetween('created_at', [$startAt, $endAt]);

    }

    //状态条件
    public function scopeStatusCode($query, $statusCode){

        return $query->where('status_code', $statusCode);

    }

    //借款人
    public function scopeLoanName($query, $loanName){

        return $query->where('loan_name', $loanName);

    }

    //合同编号
    public function scopeContactNo($query, $contactNo){

        return $query->where('contact_no', $contactNo);

    }

    //项目id
    public function scopeProjectId($query, $projectId){

        return $query->where('project_id', $projectId);

    }

    //多个项目id
    public function scopeProjectIds($query, $projectIds){

        return $query->whereIn('project_id', $projectIds);

    }

}