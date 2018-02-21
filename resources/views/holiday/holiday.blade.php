<?php
$title = "選擇休假日";
?>
@extends('layouts.__sunwai_head')
@section('content')
<script type="text/javascript" src="/js/web_holiday_style.js"></script>
<div class="j_holiday col-md-6 col-sm-8 col-xs-10 col-md-offset-3 col-sm-offset-2 col-xs-offset-1 panel panel-info p_l_r_dis">
	<div class="panel-heading">
      <div>
          <h1>選擇休假日</h1>
      </div>
  </div>
  <div class="panel-body">
		<form role="form" method="POST" enctype="multipart/form-data" action="/holiday/holiday" class="col-md-12 col-sm-12 col-xs-12 p_l_r_dis">
			{!! csrf_field() !!}
			<div class="col-md-1 col-sm-1 col-xs-1 p_l_r_dis">
				<button type="button" class="btn_left btn btn-info pull-left">
					<i class="fa fa-angle-left" aria-hidden="true"></i>
				</button>
			</div>
			<div class="col-md-5 col-sm-5 col-xs-5">
				<select class="form-control" id="c_year" name="c_year" data-year="{{ $case['c_year'] }}">
				</select>
			</div>
			<div class="col-md-5 col-sm-5 col-xs-5">
				<select class="form-control" id="c_month" name="c_month" data-month="{{ $case['c_month'] }}">
					<option value='1'>一月</option>
					<option value='2'>二月</option>
					<option value='3'>三月</option>
					<option value='4'>四月</option>
					<option value='5'>五月</option>
					<option value='6'>六月</option>
					<option value='7'>七月</option>
					<option value='8'>八月</option>
					<option value='9'>九月</option>
					<option value='10'>十月</option>
					<option value='11'>十一月</option>
					<option value='12'>十二月</option>
				</select>
			</div>
			<div class="col-md-1 col-sm-1 col-xs-1 p_l_r_dis">
				<button type="button" class="btn_right btn btn-info pull-right">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
				</button>
			</div>
			<button type="submit" name="submit" value="search" class="btn btn-info xxx" style="display:none;">送出</button>
		</form>
		<div class="col-md-12 col-sm-12 col-xs-12 clearfix p_l_r_dis">
			<div class="week_group col-md-12 col-sm-12 col-xs-12 p_l_r_dis">
				<div class="col-md-1 col-sm-1 col-xs-1 week_days"><h3>日</h3></div><div class="col-md-1 col-sm-1 col-xs-1 week_days"><h3>一</h3></div><div class="col-md-1 col-sm-1 col-xs-1 week_days"><h3>二</h3></div><div class="col-md-1 col-sm-1 col-xs-1 week_days"><h3>三</h3></div><div class="col-md-1 col-sm-1 col-xs-1 week_days"><h3>四</h3></div><div class="col-md-1 col-sm-1 col-xs-1 week_days"><h3>五</h3></div><div class="col-md-1 col-sm-1 col-xs-1 week_days"><h3>六</h3></div>
			</div>
			<form role="form" name="holiday_form" method="POST" enctype="multipart/form-data" action="/holiday/holiday_save">
				{!! csrf_field() !!}
				<div class="day_group col-md-12 col-sm-12 col-xs-12 p_l_r_dis">
					@foreach ($caseDate as $cd)
						<div class="col-md-1 col-sm-1 col-xs-1 input_area" data-dayofweek="{{ $cd->c_dayofweek }}">
							{{ $cd->c_day }}
							<input type="text" name="{{ $cd->c_day }}" value="{{ $cd->c_is_holiday }}">
						</div>
					@endforeach
				</div>
				<div class="btn_group col-md-12 col-sm-12 col-xs-12 p_l_r_dis">
					@if(count($caseDate))
						<button type="button" class="edit_check btn btn-primary pull-right">編輯</button>
						<button type="button" class="reset_check btn btn-warning pull-right">重設</button>
						<button type="button" class="send_check btn btn-success btn_dis pull-right" value="save">送出</button>
						<button type="button" class="cancel_check btn btn-danger btn_dis pull-right">取消</button>
					@else
					<button type="button" class="create_check btn btn-info pull-right">新建</button>
					@endif
				</div>
				<div class="show_box check_password_dis">
	        <div class="check_password">
            <div class="password_plz">
              <div class="control-label">
                <h3>輸入會員密碼：</h3>
              </div>
              <input type="password" class="form-control" name="password" value="">
              <button type="button" class="final_check btn btn-success">送出</button>
              <button type="button" class="cancel_check btn btn-danger">取消</button>
            </div>
	        </div>
		    </div>
			</form>
		</div>
  </div>
</div>

@endsection