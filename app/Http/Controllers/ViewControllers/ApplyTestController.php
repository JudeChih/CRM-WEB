<?php
namespace App\Http\Controllers\ViewControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebApplyRepository;

class ApplyTestController extends Controller
{
		protected $webapplyrepository;

    /**
     *  constructor.
     *
     * @param
     */
    public function __construct(WebApplyRepository $webapplyrepository) {
        $this->webapplyrepository = $webapplyrepository;
    }

    /**
     * View [ ApplyTest ] Route
     * @return type
     */
    function applyTest() {

        // $problemlist = \App\Repositories\WebProblemCategoryRepository::withNew()->getProblemCategory();

        $grouplist = \App\Repositories\WebProductGroupRepository::withNew()->getPluckSupportCaseGroup();

        // $data = ['problem' => $problemlist, 'productgroup' => $grouplist];

        // return view('applytest.applyfortest', compact('problemlist', 'grouplist', 'problemsublist'));
        return view('applytest.applyfortest', compact('grouplist'));
    		// return view('/applytest/applyfortest');
    }

    /**
   	* View [ ApplyTest ] Action
   	* @param Request $request
   	* @return type
   	*/
    function createApplyCase(Request $request) {

        $case_number = $this->webapplyrepository->createNewCase($request->all());

        if (isset($case_number)) {
            return view('applytest.applysuccess', compact('case_number'));
        }

        return redirect()->back()->withInput()->withErrors(['error' => '系統異常請稍候再試！！']);
    }
}
