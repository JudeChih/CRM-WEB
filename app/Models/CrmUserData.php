<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmUserData extends Model {

    /**
     * 資料表名稱
     * @var string
     */
    protected $table = 'CrmUserData';

    /**
     * 主鍵值
     * @var string
     */
    protected $primaryKey = 'ud_id';

    /**
     * 是否自動遞增
     * @var string
     */
    public $incrementing = false;

    /**
     * 是否自動插入現在時間
     *
     * @var bool
     */
    public $timestamps = false;

    public function CrmDepartment() {
        return $this->hasMany('App\Models\CrmDepartment', 'dep_id');
    }

    public function AuthRole() {
        return $this->getAuth($this->ud_id);
    }

    /**
     * 使用該「使用者代碼」取得「權限角色」陣列
     * @param type $ud_id 使用者代碼
     * @return array
     */
    public function getAuth($ud_id) {

        $department = $this
                /*->model*/
                ->join('CrmDepartment', 'CrmUserData.dep_id', '=', 'CrmDepartment.dep_id')
                ->where('CrmUserData.ud_id', '=', $ud_id)
                ->where('CrmUserData.isflag', '=', '1')
                ->first();

        if (!isset($department) || count($department) <= 0) {
            return [];
        }
        $auth[] = ($this->checkDepartmentType($department->dep_type));
        $headdata = $this->getDepartmentHead($ud_id);
        if (!isset($headdata) || count($headdata) <= 0) {
            return $auth;
        }
        foreach ($headdata as $head) {
            $auth[] = ($this->checkDepartmentType($head->dep_type) . '_head');
        }

        return $auth;
    }

    /**
     * 檢查部門類別
     * @param type $departmentType
     * @return string
     */
    private function checkDepartmentType($departmentType) {
        switch ($departmentType) {
            case '0':// 0:總經理室
                return 'generalmanager';
            case '1':// 1:客服類別
                return 'cs';
            case '2':// 2:工程類別
                return 'engineer';
            case '3':// 3:業務類別
                return 'sales';
            case '4':// 4:軟體類別
                return 'software';
            case '5':// 5:會計類別
                return 'accounting';
            case '99':// 99:行政其他類別
                return 'other';
            default:
                return '';
        }
    }

    /**
     * 
     * @param type $ud_id
     */
    private function getDepartmentHead($ud_id) {
        return \DB::table('CrmDepartment')
                        ->join('CrmManagerRelation', 'CrmManagerRelation.mr_id', '=', 'CrmDepartment.dep_id')
                        ->where('CrmManagerRelation.ud_id', '=', $ud_id)
                        ->select('CrmDepartment.dep_type')
                        ->distinct()
                        ->get();
    }

}
