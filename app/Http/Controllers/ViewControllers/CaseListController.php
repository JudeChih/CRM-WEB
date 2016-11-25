<?php
namespace App\Http\Controllers\ViewControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebSupportCaseRepository;
use Illuminate\Support\Facades\DB;


class CaseListController extends Controller
{
		protected $websupportcaserepository;

    /**
     * constructor.
     * @param
     */
    public function __construct(WebSupportCaseRepository $websupportcaserepository) {
        $this->websupportcaserepository = $websupportcaserepository;
    }

    /**
     * View [ ApplyTest ] Route
     * @return type
     */
    function caseList() {

        // $problemlist = \App\Repositories\WebProblemCategoryRepository::withNew()->getProblemCategory();

        // $grouplist = \App\Repositories\WebProductGroupRepository::withNew()->getSupportCaseGroup();

        // $data = ['problem' => $problemlist, 'productgroup' => $grouplist];

        // return view('applytest.applyfortest', compact('problemlist', 'grouplist', 'problemsublist'));
    		return view('/supportcase/caselist');
    }

    public function caseData() {
  		$reusls = \App\Models\WebCaseList::paginate(10);
      return \Illuminate\Support\Facades\View::make('/supportcase/caselist')->with("caseList", $reusls);
  	}

  	public function caseDetail($id) {
  		$reusls = \App\Models\WebCaseList::where('case_number', $id)->first();
      return \Illuminate\Support\Facades\View::make('/supportcase/caselistdetail')->with("caseList", $reusls);
      // return $user;
  	}
}
