<h3>Facebook Leads</h3>

@if(count($leads) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Created Time</th>
                <th>Lead Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
                <tr>
                    <td>{{ $lead['created_time'] ?? '-' }}</td>
                    <td>
                        @foreach($lead['field_data'] as $field)
                            <strong>{{ $field['name'] }}:</strong> {{ $field['values'][0] ?? '' }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No leads found for this form.</p>
@endif
