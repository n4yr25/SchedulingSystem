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
        height: 120px;        /* fixed height for all cells */
        vertical-align: bottom; /* keep text at bottom */
        text-align: center;
        position: relative;   /* allows absolute positioning */
        padding-bottom: 25px; /* space for text */
    }

    .footer img {
        left: 50%;
        transform: translateX(-50%); /* center horizontally */
        height: 50px;         /* fixed small size */
        pointer-events: none; /* makes image non-interactive */
    }
    .footer .label {
        font-weight: bold;
        text-decoration: underline;
        display: block;
        margin-top: 5px;
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
        </tr>
      </thead>
      <tbody>
@php
    use Carbon\Carbon;

    $days = ['M', 'T', 'W', 'Th', 'F'];
    $timeSlots = [
        '08:00 - 09:00','09:00 - 10:00','10:00 - 11:00',
        '11:00 - 12:00','12:00 - 13:00','13:00 - 14:00','14:00 - 15:00',
        '15:00 - 16:00','16:00 - 17:00',
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
          Prepared by: <br>
          @if ($prepby && $prepby->signature_path)
            <img src="{{ public_path('uploads/signatures/' . $prepby->signature_path) }}" alt="Signature">
          @endif
          <div class="label">{{ $prepby ? $prepby->fullname : '' }}</div>
          {{ $prepby ? $prepby->position : '' }}
        </td>


    <td>
      Recommending Approval: <br>
      @if ($rec_approval && $rec_approval->signature_path)
        <img src="{{ public_path('uploads/signatures/' . $rec_approval->signature_path) }}" width="120">
      @endif
      <div class="label">{{ $rec_approval ? $rec_approval->fullname : '' }}</div>
      {{ $rec_approval ? $rec_approval->position : '' }}
    </td>

    <td>
      Approved: <br>
      @if ($approved && $approved->signature_path)
        <img src="{{ public_path('uploads/signatures/' . $approved->signature_path) }}" width="120">
      @endif
      <div class="label">{{ $approved ? $approved->fullname : '' }}</div>
      {{ $approved ? $approved->position : '' }}
    </td>

    <td>
      Conforme: <br>
      @if ($conforme && $conforme->signature_path)
        <img src="{{ public_path('uploads/signatures/' . $conforme->signature_path) }}" width="120">
      @endif
      <div class="label">{{ $conforme ? $conforme->fullname : '' }}</div>
      {{ $conforme ? $conforme->position : '' }}
    </td>
  </tr>
</table>
  </body>
</html>
