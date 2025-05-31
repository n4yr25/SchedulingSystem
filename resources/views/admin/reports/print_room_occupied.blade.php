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
          <span style="font-weight: bold">
            ROOM {{ $room ? $room : '' }}
          </span>
          <br />
          <span style="font-weight: bold">
            A.Y. {{ $curriculum_year }} - {{ $curriculum_year + 1 }}
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
            $days = ['M', 'W', 'T', 'TH', 'F', 'S'];
            $timeSlots = [
                '07:00 - 08:00','08:00 - 09:00','09:00 - 10:00','10:00 - 11:00',
                '11:00 - 12:00','12:00 - 01:00','01:00 - 02:00','02:00 - 03:00',
                '03:00 - 04:00','04:00 - 05:00','05:00 - 06:00','06:00 - 07:00'
            ];
            @endphp

            @foreach($timeSlots as $slot)
            <tr>
                <td>{{ $slot }}</td>
                @foreach($days as $day)
                   <td>
                        @foreach ($schedules as $sched)
                            @if ($sched->day == $day)
                                {{ $sched->day }}<br />
                                {{ $sched->course_code }}<br />
                                {{ $sched->course_name }}<br />
                                {{ $sched->name }} {{ $sched->lastname }}
                            @endif
                        @endforeach
                   </td>
                @endforeach
            </tr>
            @endforeach

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
