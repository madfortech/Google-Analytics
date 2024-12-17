<h1>Active Users</h1>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Active 1-Day Users</th>
                <th>Active 7-Day Users</th>
                <th>Active 28-Day Users</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report->rows as $row)
                <tr>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->metrics->active1DayUsers }}</td>
                    <td>{{ $row->metrics->active7DayUsers }}</td>
                    <td>{{ $row->metrics->active28DayUsers }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>