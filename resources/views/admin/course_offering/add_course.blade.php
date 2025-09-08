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
<?php
$programs = \App\academic_programs::distinct()->orderBy('program_code')->get(array('program_code', 'program_name'));?>
@extends($layout)

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('main-content') 
<link rel='stylesheet' href='{{asset('plugins/select2/select2.css')}}'>
<section class="content-header">
    <h1><i class="fa fa-bullhorn"></i>  
        Add Course
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Curriculum Management</a></li>
        <li class="active"><a>Add Course</a></li>
    </ol>
</section>
<section class="content container-fluid">
                    
    <div class="box box-default">
        <form action="{{url('/admin/course_offerings/save_course')}}" method="post">
        {{csrf_field()}}
        <div class="box-header"><i ></i>
            <h5 class='box-title'></h5>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dynamic_field">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Program Code</th>
                            <th>Program Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><button class="add btn btn-flat btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                            <td><input type="text" class="form-control" name="program_code[]" id="c_year1"></td>
                            <td><input type="text" class="form-control" name="program_name[]" id="code1"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button onclick="submit()" class="btn btn-flat btn-success"><i class="fa fa-check-circle"></i> Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</section>

<script></script>
@endsection

@section('footer-script')
<script src='{{asset('plugins/select2/select2.js')}}'></script>
<script></script>
<script>
   var no = 1;
    $('.add').on('click',function(e){
    if($("#c_year"+no).val()=="" || $("#code" + no).val()=="" ){
        toastr.warning("Please Fill-up Required Fields ");
    }else{
        no++;
        $('#dynamic_field').append("<tr id='row"+no+"'>\n\
                <td><button class='btn btn-flat btn-danger remove' id='"+no+"'><i class='fa fa-close'></i></button></td>\n\
                <td><input type='text' name='program_code[]' class='form-control' id='c_year"+no+"'></td>\n\
                <td><input type='text' class='form-control' name='program_name[]' id='code"+no+"'></td>\n\
            </tr>");
    }
    e.preventDefault();
    return false;
})

$('#dynamic_field').on('click','.remove', function(e    ){
    var button_id = $(this).attr("id");
    $("#row"+button_id+"").remove();
    i--;
    e.preventDefault();
    return false;
}); 

</script>
@endsection

