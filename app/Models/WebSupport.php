<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebSupport extends Model {

    /**
     * 資料表名稱
     * @var string
     */
    protected $table = 'WebSupport';

    /**
     * 主鍵值
     * @var string
     */
    protected $primaryKey = 'support_id';

    /**
     * 是否自動遞增
     * @var string
     */
    public $incrementing = true;

    /**
     * 是否自動插入現在時間
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 可異動的資料欄位
     * @var type 
     */
//    protected $fillable = [
//        'case_number', 'case_status', 'create_date', 'deadline_take', 'deadline_close',
//        'comp_name', 'contact_name', 'contact_mail', 'contact_phone',
//        'pg_id', 'pd_id', 'product_version', 'problem_id', 'problem_parent',
//        'support_subject', 'support_description', 'support_filename',
//        'take_user', 'take_date',
//        'close_user', 'close_date', 'close_description', 'close_filename',
//        'extend_user', 'extend_date', 'extend_reason', 'extend_expect_date'
//    ];

    /**
     * 不可異動的值
     * @var type 
     */
//    protected $guarded = ['support_id'];
    /**
     * 對應資料表「WebSupport_User」
     * @return type
     */
    public function supportUsers() {
        return $this->hasMany('App\Models\WebSupportUser', 'support_id');
    }

    /**
     * 對應資料表「WebProductGroup」
     * @return type
     */
    public function productGroup() {
        return $this->belongsTo('App\Models\WebProductGroup', 'pg_id', 'pg_id');
    }

    /**
     * 對應資料表「WebProductData」
     * @return type
     */
    public function productData() {

        return $this->belongsTo('App\Models\WebProductData', 'pd_id', 'pd_id');

        return $this->hasOne('App\Models\WebProductData', 'pd_id', 'pd_id');
    }

    /**
     * 對應資料表「WebProblemCategory」
     * @return type
     */
    public function problemCategory() {
        return $this->belongsTo('App\Models\WebProblemCategory', 'problem_parent', 'problem_id');
    }

    /**
     * 對應資料表「WebProblemCategory」
     * @return type
     */
    public function subProblemCategory() {
        return $this->belongsTo('App\Models\WebProblemCategory', 'problem_id', 'problem_id');
    }

    /**
     * 接案工程師
     * @return type
     */
    public function takeCaseEngineer() {
        return $this->supportUsers()->where('user_role', '=', 1);
    }

    /**
     * 接案工程師名稱
     * @return string
     */
    public function takeCaseEnginnerName() {

        $takecase = $this->supportUsers()->where('user_role', '=', 1)->first();

        if (count($takecase) > 0 && count($takecase->userData) > 0) {
            return $takecase->userData->ud_cname;
        }

        return '';
    }

    /**
     * 接案時間
     * @return string
     */
    public function takeCaseTime() {

        $takecase = $this->supportUsers()->where('user_role', '=', 1)->first();

        if (count($takecase) > 0) {
            return $takecase->add_date;
        }

        return '';
    }

    /**
     * 支援工程師
     * @return type
     */
    public function supportCaseEnginner() {
        return $this->supportUsers()->where('user_role', '=', 2);
    }

    /**
     * 支援工程師名稱
     * @return string
     */
    public function supportCaseEnginnerName() {

        $takecase = $this->supportUsers()->where('user_role', '=', 2)->first();
        //echo json_encode($takecase);
        if (count($takecase) > 0 && count($takecase->userData) > 0) {
            return $takecase->userData->ud_cname;
        }

        return '';
    }

    /**
     * 接案工程師
     * @return type
     */
    public function sales() {
        return $this->supportUsers()->where('user_role', '=', 3);
    }

    /**
     * 業務名稱
     * @return string
     */
    public function salesName() {

        $takecase = $this->supportUsers()->where('user_role', '=', 3)->first();

        if (count($takecase) > 0 && count($takecase->userData) > 0) {
            return $takecase->userData->ud_cname;
        }

        return '';
    }

    /**
     * 對應資料表「CrmCustomerData」
     */
    public function customerData() {
        return $this->belongsTo('App\Models\CrmCustomerData', 'cd_id', 'cd_id');
    }

    public function caseStatus() {
        switch ($this->case_status) {
            case 0://0	新案件
                return '新案件';
            case 1://1	處理中
                return '處理中';
            case 2://2	展延
                return '展延';
            case 3://3	工程師結案
                return '工程師結案';
            case 4://4	客戶結案
                return '客戶結案';
            case 9://9	取消
                return '取消';
        }
    }

}
