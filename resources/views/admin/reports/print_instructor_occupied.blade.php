<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <style>
      body {
        font-family: Arial, sans-serif;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
      }
      th,
      td {
        border: 1px solid black;
        padding: 6px;
        text-align: center;
        vertical-align: middle;
      }
      .header-table {
        width: 100%;
        border: 1px solid black;
        margin-bottom: 10px;
      }
      .header-table td {
        border: none;
        text-align: center;
      }
      .logo {
        width: 80px;
      }
      .title {
        font-size: 18px;
        font-weight: bold;
      }
      .subtitle {
        font-size: 14px;
      }
      .footer {
        width: 100%;
        border: 1px solid black;
        margin-top: 20px;
        font-size: 11px;
        text-align: center;
      }
      .footer td {
        border: 1px solid black;
        height: 60px;
        vertical-align: bottom;
      }
      .footer .label {
        font-weight: bold;
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <table class="header-table">
      <tr>
        <td style="width: 15%">
          <img
            src="{{ public_path('logo/logo.png') }}"
            alt="Logo"
            class="logo"
          />
        </td>
        <td>
          <div class="title">SHORTENED CLASS SCHEDULE</div>
          <div class="subtitle">Pangasinan State University</div>
        </td>
      </tr>
    </table>

    <table class="header-table">
      <tr>
        <td>
          {{-- <span style="font-weight: bold">
            ROOM {{ $room ? $room : '' }}
          </span>
          <br /> --}}
          <span style="font-weight: bold">
            {{ $semester ? $semester : '' }}, 
            {{ $curriculum_year }} - {{ $curriculum_year + 1 }} / Summer 20__. Asingan Campus
            </br>
            Name of Faculty: {{ $faculty ? strtoupper($faculty) : '' }}
          </span>
        </td>
      </tr>
    </table>

    <table>
      <thead>
        <tr>
          <th>TIMEs</th>
          <th>Monday</th>
          <th>Tuesday</th>
          <th>Wednesday</th>
          <th>Thursday</th>
          <th>Friday</th>
          <th>Saturday</th>
        </tr>
      </thead>
      <tbody>
@php
    use Carbon\Carbon;

    $days = ['M', 'T', 'W', 'Th', 'F', 'Sa'];
    $timeSlots = [
        '07:00 - 08:00','08:00 - 09:00','09:00 - 10:00','10:00 - 11:00',
        '11:00 - 12:00','12:00 - 13:00','13:00 - 14:00','14:00 - 15:00',
        '15:00 - 16:00','16:00 - 17:00','17:00 - 18:00','18:00 - 19:00'
    ];

    // Parse time slots
    $parsedSlots = [];
    foreach ($timeSlots as $slot) {
        [$start, $end] = explode(' - ', $slot);
        $parsedSlots[] = [
            'label' => Carbon::createFromFormat('H:i', $start)->format('h:i A') . ' - ' . Carbon::createFromFormat('H:i', $end)->format('h:i A'),
            'start' => Carbon::createFromFormat('H:i', $start),
            'end' => Carbon::createFromFormat('H:i', $end),
        ];
    }

    $rendered = [];
@endphp

@for ($i = 0; $i < count($parsedSlots); $i++)
    <tr>
        <td>{{ $parsedSlots[$i]['label'] }}</td>
        @foreach($days as $day)
            @php
                if (isset($rendered[$day][$i]) && $rendered[$day][$i]) {
                    continue;
                }
                $printed = false;
            @endphp

            @foreach ($schedules as $sched)
                @php
                    if ($sched->day != $day) continue;

                    $schedStart = Carbon::createFromFormat('H:i:s', $sched->time_starts);
                    $schedEnd = Carbon::createFromFormat('H:i:s', $sched->time_end);

                    if ($schedStart->eq($parsedSlots[$i]['start'])) {
                        $rowspan = 0;
                        for ($j = $i; $j < count($parsedSlots); $j++) {
                            if ($schedStart < $parsedSlots[$j]['end'] && $schedEnd > $parsedSlots[$j]['start']) {
                                $rowspan++;
                                $rendered[$day][$j] = true;
                            }
                        }
                @endphp

                <td rowspan="{{ $rowspan }}">
                    RM. {{ $sched->room }}<br>
                    {{ $sched->program_code }} - 
                    {{ $sched->course_code }}<br>
                    {{ $sched->section_name }}<br>
                    {{ $sched->level }}
                </td>

                @php
                        $printed = true;
                        break;
                    }
                @endphp
            @endforeach

            @if (!$printed)
                <td></td>
            @endif
        @endforeach
    </tr>
@endfor



      </tbody>
    </table>

    <table class="footer">
      <tr>
        <td>
          Prepared by: <br><br><br>
          <div class="label">WILMAR JENNIE V. MOTEA, MIT</div>
          Department Chairperson<br />
        </td>
        <td>
          Recommending Approval: <br><br><br>
          <div class="label">JB O. DORIA, MIT</div>
          College Dean<br />
        </td>
        <td>
          Approved: <br><br><br>
          <div class="label">MADLYN D. TINGCO, DPA</div>
          Campus Executive Director<br />
        </td>
        <td>
          Conforme: <br><br><br>
          <div class="label">&nbsp;&nbsp;&nbsp;&nbsp;</div>
          Faculty<br />
        </td>
      </tr>
    </table>
  </body>
</html>
