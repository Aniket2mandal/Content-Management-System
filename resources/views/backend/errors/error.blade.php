@extends('backend.layout.adminlayout')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header bg-danger text-white">
            <h4>Error Log</h4>
        </div>
        <div class="card-body">
            @if(!empty($filteredLogs))
                @foreach($filteredLogs as $log)
                    <table class="table table-bordered">
                        <tr>
                            <th>Log Data</th>
                            <td>{{ $log }}</td>
                        </tr>
                    </table>
                    <hr> {{-- Adds a separator between logs --}}
                @endforeach
            @else
                <p class="text-danger">No error data available.</p>
            @endif
        </div>
    </div>
</div>
@endsection
