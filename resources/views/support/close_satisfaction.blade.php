<?php
$title = "滿意度調查";
?>
@extends('layouts.__sunwai_head')
@section('content')
<script type="text/javascript" src="/js/survey_style.js"></script>
<div class="survey_form_style col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
    <div class="survey_title col-md-12 col-sm-12 col-xs-12">
    	<h1 class="text-center">滿意度調查</h1>
    </div>
    <form role="form" name="supportSurveyForm" action="/support/close_satisfaction" class="survey_form col-md-12 col-sm-12 col-xs-12 p_l_r_dis" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {{-- {{ Form::hidden('case_number', $casedata->case_number) }} --}}
        <div class="survey_sati col-md-12 col-sm-12 col-xs-12">
        		<div class="col-md-offset-7 col-sm-offset-7 col-xs-offset-7 col-md-1 col-sm-1 col-xs-1 p_l_r_dis"><br>很<br>滿<br>意</div>
        		<div class="col-md-1 col-sm-1 col-xs-1 p_l_r_dis"><br><br>滿<br>意</div>
        		<div class="col-md-1 col-sm-1 col-xs-1 p_l_r_dis"><br><br>尚<br>可</div>
        		<div class="col-md-1 col-sm-1 col-xs-1 p_l_r_dis"><br>不<br>滿<br>意</div>
        		<div class="col-md-1 col-sm-1 col-xs-1 p_l_r_dis">很<br>不<br>滿<br>意</div>
        </div>
        @foreach ($satisfaction as $ss)
          <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <label for="score{{ sprintf("%02d",$ss->ss_sort) }}" class="control-label problem_subject p_l_r_dis col-md-12 col-sm-12 col-xs-12">
              		<input type="hidden" name="problem{{ sprintf("%02d",$ss->ss_sort) }}" value="{{ $ss->ss_id }}">
              		<span class="col-md-7 col-sm-7 col-xs-7">{{ $ss->ss_description }}</span>
	                <input class="col-md-offset-7 col-sm-offset-7 col-xs-offset-7 col-md-1 col-sm-1 col-xs-1" type="radio" name="score{{ sprintf("%02d",$ss->ss_sort) }}" value="5">
	                <input class="col-md-1 col-sm-1 col-xs-1" type="radio" name="score{{ sprintf("%02d",$ss->ss_sort) }}" value="4">
	                <input class="col-md-1 col-sm-1 col-xs-1" type="radio" name="score{{ sprintf("%02d",$ss->ss_sort) }}" value="3">
	                <input class="col-md-1 col-sm-1 col-xs-1" type="radio" name="score{{ sprintf("%02d",$ss->ss_sort) }}" value="2">
	                <input class="col-md-1 col-sm-1 col-xs-1" type="radio" name="score{{ sprintf("%02d",$ss->ss_sort) }}" value="1">
              </label>
          </div>
        @endforeach
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label for="suggest" class="control-label">寶貴意見</label>
            <textarea type="text" class="form-control" rows="5" id="suggest"  name="suggest"></textarea>
        </div>
        <div id="error_tip" class="col-md-12 col-sm-12 col-xs-12 error_tip">
        	<span>尚未完成填寫，請務必填寫完整！</span>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 btn_style">
            <button type="submit" class="btn pull-right">送出</button>
        </div>
    </form>
</div>
@endsection