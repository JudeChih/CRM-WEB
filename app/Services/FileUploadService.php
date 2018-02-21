<?php

namespace App\Services;

class FileUploadService {

    /**
     * 檔案上傳〔檔案大小〕最大值
     * @return type
     */
    private static function maxUploadSize() {
        return 20 * 1024 * 1024;
    }

    /**
     * 〔新案件〕檔案儲存位置
     * @return string
     */
    private static function directoryNewCase() {
        return 'files/newsupportcasefiles';
    }

    /**
     * 〔結案〕檔案儲存位置
     * @return string
     */
    private static function directoryCloseCase() {
        return 'files/closesupportcasefiles';
    }

    /**
     * 檢查檔案格式與大小
     * @param type $filedata
     * @return boolean
     */
    private static function checkFile($filedata) {

        $size = $filedata->getSize();
        $extension = $filedata->getClientOriginalExtension();
        //檢查檔案大小
        if ($size > FileUploadService::maxUploadSize()) {
            return false;
        }
        //檢查檔案副檔名
        if ($extension != 'gz' && $extension != 'rar' && $extension != 'zip') {
            return false;
        }
        return true;
    }

    /**
     * 取得檔案上傳後的檔案名稱
     * @return type
     */
    private static function getNewFileName() {
        return str_replace(".", "", microtime(true));
    }

    /**
     * 儲存「新案件」檔案
     * @param type $filedata
     * @return boolean
     */
    public static function SaveNewSupportCaseFile($filedata) {
        if (!FileUploadService::checkFile($filedata)) {
            return null;
        }
        $filename = FileUploadService::getNewFileName();
        $extension = $filedata->getClientOriginalExtension();
        $fullfilename = $filename . '.' . $extension;
        $filedata->move(FileUploadService::directoryNewCase(), $fullfilename);
        return $fullfilename;
    }

    /**
     * 儲存「結案」檔案
     * @param type $filedata
     * @return boolean
     */
    public static function SaveCloseSupportCaseFile($filedata) {
        if (!FileUploadService::checkCloseSupportCaseFile($filedata)) {
            return null;
        }
        $filename = FileUploadService::getNewFileName();
        $extension = $filedata->getClientOriginalExtension();
        $fullfilename = $filename . '.' . $extension;

        $filedata->move(FileUploadService::directoryCloseCase(), $fullfilename);

        return $fullfilename;
    }

    /**
     * 檢查「結案」檔案格式與大小
     * @param type $filedata
     * @return boolean
     */
    private static function checkCloseSupportCaseFile($filedata) {

        $size = $filedata->getSize();
        $extension = $filedata->getClientOriginalExtension();
        //檢查檔案大小
        if ($size > FileUploadService::maxUploadSize()) {
            return false;
        }
        //檢查檔案副檔名
        if ($extension != 'png' && $extension != 'pdf' && $extension != 'jpg') {
            return false;
        }
        return true;
    }

}
