<?php 
$layout = "";

if(Auth::user()->is_first_login == 1){
    $layout = 'layouts.first_login';
}else{
    if(Auth::user()->accesslevel == 100){
        $layout = 'layouts.superadmin';
    }elseif(Auth::user()->accesslevel == 1){
        $layout = 'layouts.instructor';
    }elseif(Auth::user()->accesslevel == 0){
        $layout = 'layouts.admin';
    }
}


?>
<?php use Carbon\Carbon; 

?>
@extends($layout)

@section('main-content')
<link rel="stylesheet" href="{{ asset ('plugins/datatables/dataTables.bootstrap.css')}}">
<section class="content-header">
      <h1><i class="fa fa-archive"></i>  
        Reports
        <small>Section Load</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Section Load</li>
      </ol>
</section>

<div class="container-fluid" style="margin-top: 15px;">
    <div class="box box-default">
        <div class="box-header"><h5 class="box-title">Search Filters</h5></div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Sections</label>
                        <select class="form-control select2" id="section">
                            <option>Please Select</option>
                            @foreach($sections as $section)
                            <option value="{{$section->id}}">{{$section->program_code}}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;{{$section->level}}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;{{$section->section_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>&nbsp</label>
                        <button onclick="searchdata(section.value)" class="btn-block btn btn-flat btn-primary"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="displaydata"></div>
</div>

@endsection

@section('footer-script')
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
<script>
function searchdata(section){
    var array = {};
    array['section'] = section;
    $.ajax({
        type: "GET",
        url: "/ajax/admin/reports/get_sections_occupied",
        data: array,
        success: function(data){
            console.log('Search results:', data);
            $('#displaydata').html(data).fadeIn();
        }, 
        error: function(xhr, status, error) {
            console.error('Export failed:', error);
           
        }
    })
}
</script>
@endsection
