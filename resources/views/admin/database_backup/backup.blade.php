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
      <h1><i class="fa fa-database"></i>  
        Database Backup
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Database Backup</li>
      </ol>
</section>


<div class="container-fluid" style="margin-top: 15px;">
    <div class="box box-default">
        <div class="box-header with-border">
            <a href="{{ url('admin/database_backup/save') }}" class="btn btn-primary">
                <i class="fa fa-database"></i> Export Database
            </a>
        </div>
       
        <div class="box-body">
            <div class="table-responsive" id="reloadtabular">
                @if(count($savedb)>0)
                <table class="table table-bordered table-striped" id="example2">
                    <thead>
                        <tr>
                            <th width="20%">Filename</th>
                            <th width="10%">Date Created</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($savedb as $savedb)
                        <tr>
                            <td>{{$savedb['filename']}}</td>
                            <td>{{ \Carbon\Carbon::parse($savedb['created_at'])->format('Y-m-d') }}</td>
                            <td>

                                <a href="{{ url('admin/database_backup/download', $savedb['id']) }}" class="btn btn-primary btn-xs">
                                    <i class="fa fa-download"></i>
                                </a>
                                <form action="{{ url('admin/database_backup/restore', $savedb['id']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want to restore this backup? This will overwrite current data.')">
                                        <i class="fa fa-history"></i>
                                    </button>
                                </form>
                                <form action="{{ url('admin/database_backup/delete', $savedb['id']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this backup?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="callout callout-warning">
                    <div align="center"><h5>No Saved Database Backup!</h5></div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer-script')
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
<script>
    $('#example2').DataTable({})
    
    function changenotifstatus(notif_id){
        var array = {};
        array['notif_id'] = notif_id;
        $.ajax({
            type: "GET",
            url: "/ajax/admin/faculty_loading/reloadnotif",
            data: array,
            success: function(data){
                toastr.info('Updated the status of the notification','Notification!');
                $('#reloadtabular').html(data).fadeIn();
                $('#example2').DataTable({})
            },error: function(){
                toastr.error('Something Went Wrong!','Notification!');
            }
        })
    }
     @if(session('success'))
        toastr.success("{{ session('success') }}", "Success!");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}", "Error!");
    @endif

    @if(session('info'))
        toastr.info("{{ session('info') }}", "Info!");
    @endif
</script>
@endsection
