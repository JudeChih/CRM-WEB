<?php

namespace App\Http\Controllers\ViewControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebSupportRepository;

class MailTextViewController extends Controller {

    protected $repository;

    /**
     *  constructor.
     *
     * @param
     */
    public function __construct(WebSupportRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * View [ mail系列 ] Route，開啟頁面「信件內容」
     * @param Request $request
     */
    public function mailNewCaseEngineer(Request $request) {

        $caselist = $this->repository->getListDataPage();

        return view('\emails.new_case_engineer', compact('caselist'));
    }
    public function mailNewCaseCustomer(Request $request) {

        $caselist = $this->repository->getListDataPage();

        return view('\emails.new_case_customer', compact('caselist'));
    }
    public function closeSatisfaction(Request $request) {

        $caselist = $this->repository->getListDataPage();

        return view('\emails.close_satisfaction', compact('caselist'));
    }
    public function overTakeDeadline(Request $request) {

        $caselist = $this->repository->getListDataPage();

        return view('\emails.over_take_deadline', compact('caselist'));
    }
    public function overCloseDeadline(Request $request) {

        $caselist = $this->repository->getListDataPage();

        return view('\emails.over_close_deadline', compact('caselist'));
    }
    public function applyForTest(Request $request) {

        $caselist = $this->repository->getListDataPage();

        return view('\emails.apply_for_test', compact('caselist'));
    }
}
