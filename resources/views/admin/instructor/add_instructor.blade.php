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
<?php $programs= \App\academic_programs::distinct()->get(['program_name','program_code'])?>

@extends($layout)
@section('messagemenu')
<li class="dropdown messages-menu">
    <!-- Menu toggle button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-envelope-o"></i>
        <span class="label label-success"></span>
    </a>
</li>
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning"></span>
    </a>
</li>

<li class="dropdown tasks-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-flag-o"></i>
        <span class="label label-danger"></span>
    </a>
</li>
@endsection
@section('header')
<section class="content-header">
      <h1><i class="fa  fa-user-plus"></i>  
        Add New Instructor
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Add new instructor</li>
      </ol>
</section>
@if(Session::has('success'))
<div class='col-sm-12'>
    <div class='callout callout-success'>
        {{Session::get('success')}}
    </div>
</div>
@endif

<section class="content">
    <div class="row">
        <form class="form-horizontal" method='post' action='{{url('/admin', array('instructor', 'add_new_instructor'))}}'>
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title"><b>Personal Information</b></h3>
                </div>
                @if (count($errors) > 0)
                @foreach($errors->all() as $error)
                <script type="text/javascript">
                    toastr.error(' <?php echo $error ?>', 'Message!');
                </script>
                @endforeach
                @endif
                        
<!--    <div class="box-body">
        <div class="row" style="padding:20px;">
            <form action="{{ url('/Resident/Store') }}" method="post" files="true" enctype="multipart/form-data">
                <div class="form-group" style="margin-top:10px; border:0px solid black; padding:10px" >
                    <center><img class="img-responsive" id="pic" src="{{ URL::asset('img/steve.jpg')}}" width="300px" style="max-width:200px; background-size: contain" /></center>
                    <b><label style="margin-top:20px;" for="exampleInputFile">Photo Upload</label></b>
                    <input type="file" class="form-control-file" name="image" onChange="readURL(this)" id="exampleInputFile" aria-describedby="fileHelp">
                </div>
                <div class="form-group">
                          </span>
                        </div>
                      </div>
                    </div>
                    -->
                    
                <div class="box-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label><b>ID Number</b><span style="color:red; margin-left: 2px;">*</span></label>
                            <input class="form form-control" id="username" name="username" placeholder="ID Number" onkeyup="isUsernameExist()" value="{{old('instructor_id')}}" type="text" required>
                            <p id="usernameValidation"></p>
                        </div>
                        <div class="col-sm-9">
                            <label><b>Email</b></label>
                            <input class="form form-control" name='email' placeholder='Email Address' value="" type="email">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label><b>Name</b><span style="color:red; margin-left: 2px;">*</span></label>
                            <input class="form form-control" name='name' placeholder='First Name*' value="{{old('name')}}" type="text" required>
                        </div>
                        <div class="col-sm-3">
                            <label>&nbsp;</label>
                            <input class="form form-control" name='middlename' placeholder='Middle Name' value="{{old('middlename')}}" type="text">
                        </div>
                        <div class="col-sm-3">
                            <label>&nbsp;</label>
                            <input class="form form-control" name='lastname' placeholder='Last Name*' value="{{old('lastname')}}" type="text" required>
                        </div>
                        <div class="col-sm-3">
                            <label>&nbsp;</label>
                            <input class="form form-control" name='extensionname' placeholder='Extension Name' value="{{old('extensionname')}}" type="text">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label><b>Address</b><span style="color:red; margin-left: 2px;">*</span></label>
                            <input class="form form-control" name='street' placeholder='Street Address' value="{{old('street')}}" type="text">
                        </div>
                        <div class="col-sm-6">
                            <label>&nbsp;</label>
                            <input class="form form-control" name='barangay' placeholder='Barangay*' value="{{old('barangay')}}" type="text" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-6">
                            <input class="form form-control" name='municipality' placeholder='Municipality/City*' value="{{old('municipality')}}" type="text" required>
                        </div>
                        <div class="col-sm-6">
                            <input class="form form-control" name='province' placeholder='Province*' value="{{old('province')}}" type="text" required>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label><b>Gender</b><span style="color:red; margin-left: 2px;">*</span></label>
                            <select class="select2 form form-control" name='gender' type="text" required>
                                <option value=''>Select Gender</option>
                                <option value='Male'>Male</option>
                                <option value='Female'>Female</option>
                            </select>
                        </div>
                
                        <div class="col-sm-4">
                            <label><b>Contact Number</b><span style="color:red; margin-left: 2px;">*</span></label>
                            <input class="form form-control" name='tel_no' placeholder='Telephone Number' value="" type="text" required>
                        </div>
                
                    </div>
                </div>
            </div>    
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><b>Other Information</b></h3>
                </div>
                <div class="box-body">
                    <!-- <div class="col-sm-4">
                        <label><b>College</b></label>
                        <select name="department" class="select2 form form-control">
                            <option value="">Select College</option>
                            <option value="College of Information Technology">College of Information Technology</option>
                            <option value="College of Business Administration">College of Business Administration</option>
                            <option value="College of Education">College of Education</option>
                            <option value="College of Accountancy">College of Accountancy</option>
                        </select>
                    </div> -->
                    <div class="col-sm-4">
                        <label><b>Department</b><span style="color:red; margin-left: 2px;">*</span></label>
                        <select name="college" class="select2 form form-control" required>
                            <option value="">Select Department</option>
                            @foreach($programs as $program)
                            <option value="{{$program->program_code}}">{{$program->program_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label><b>Employee Status</b><span style="color:red; margin-left: 2px;">*</span></label>
                        <select name="employee_type" class="select2 form form-control" required>
                            <option value="">Select Employee Type</option>
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                        </select>
                    </div>
                </div>
            </div>
                    
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><b>Account Information</b></h3>
                </div>
                <div class="box-body">
                    <div class="form form-group row">
                        <div class="col-sm-6">
                            <label><b>Password</b></label>
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                        </div>
                        <div class="col-sm-6">
                            <label><b>Confirm Password</b></label>
                            <input type="password" 
                                class="form-control" 
                                placeholder="Confirm Password" 
                                name="confirm_password" 
                                id="confirm_password" 
                                required
                                onkeyup="this.setCustomValidity(this.value !== document.getElementById('password').value ? 'Passwords do not match' : ''); 
                                            document.getElementById('passwordHelp').textContent = this.value !== document.getElementById('password').value ? 'Passwords do not match!' : '';">
                            <small id="passwordHelp" class="text-danger"></small>
                        </div>
                    </div>
                </div>

            </div>

            <div class='form form-group'>
                <div class='col-sm-12'>
                    <input type='submit' class='col-sm-12 btn btn-primary' value='SAVE'>
                </div>
            </div>
        </form>       
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function isUsernameExist() {
    var username = document.getElementById("username").value;

    if (username.trim() === "") {
        document.getElementById("usernameValidation").innerHTML = "";
        return;
    }

    $.ajax({
        type: "GET",
        url: "/admin/instructor/verify_username/" + username,
        success: function(response) {
            if (response == 1) {
                document.getElementById("usernameValidation").innerHTML = 
                "<span style='color:red; font-weight:bold;'>Username already exists.</span>";
            } else {
                document.getElementById("usernameValidation").innerHTML = 
                "<span style='color:green; font-weight:bold;'>Username available.</span>";
            }
        },
        error: function() {
            document.getElementById("usernameValidation").innerHTML = "Error checking username.";
        }
    });
}
</script>

@endsection
@section('footerscript')
@endsection
