@if(count($schedules)>0)
<div class="box box-default">
    <div class="box-header">
        <h5 class="box-title">Search Results</h5>
        <div class="box-tools pull-right">
            <button id="signatories" class="btn btn-flat btn-primary"><i class="fa fa-user"></i> Signatories</button>
            <a href="{{url('/admin/reports/print_sections_occupied',array($section))}}" target="_blank" class="btn btn-flat btn-primary"><i class="fa fa-print"></i> Generate PDF</a>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th>Day</th>
                        <th>Schedule</th>
                        <th>Room</th>
                        <th>Instructor</th>
                        <th>Section</th>
                        {{-- <th>Building</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedules as $schedule)
                    <?php 
                        // $detail_room = \App\Models\OfferingsInfo::join('room_schedules','room_schedules.offering_id','=','offerings_infos.id')
                        // ->join('ctr_rooms','ctr_rooms.room','=','room_schedules.room')
                        // ->where('room_schedules.id', $schedule->id)
                        // ->select('ctr_rooms.building') // Select only what you need
                        // ->first(); 
                    ?>
                    <tr>
                        <td>{{$loop->iteration}}</td> 
                        <td>{{$schedule->day}}</td>
                        <td>{{date('g:i A',strtotime($schedule->time_starts))}} - {{date('g:i A',strtotime($schedule->time_end))}}</td>
                        <td>{{$schedule->room}}</td>
                        <td>{{$schedule->lastname}}, {{$schedule->name}}</td>
                        <td>{{$schedule->section_name}}</td>
                        {{-- <td>{{$detail_room->building}}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="box box-danger">
    <div class="box-header"><h5 class="box-title">Search Results</h5></div>
    <div class="box-body">
        <div align="callout callout-warning">
            <div align="center">
                <h5>No Results Found!</h5>
            </div>
        </div>
    </div>
</div>
@endif

<div id="myModal" class="modal fade" role="dialog">
    asdf
    <div id='displayedit'>
    </div>
</div>

<script>
    $('#signatories').on('click', function() {
        console.log('Signatories button clicked');
        
        $.ajax({
            type: "GET",
            url: "/ajax/admin/reports/signatories",
            success: function(data) {
                $('#displayedit').html(data).fadeIn();
                $('#myModal').modal('show');
            }
        });
    });

</script>