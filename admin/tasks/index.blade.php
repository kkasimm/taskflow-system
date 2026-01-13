@extends('admin.layout.app')

@section('content')

<h3 class="mb-4">Dashboard</h3>

<div class="row mb-4">
    <div class="col">Users: <strong>{{ $totalUsers }}</strong></div>
    <div class="col">Tasks: <strong>{{ $totalTasks }}</strong></div>
    <div class="col">Todo: <strong>{{ $todo }}</strong></div>
    <div class="col">Progress: <strong>{{ $progress }}</strong></div>
    <div class="col">Done: <strong>{{ $done }}</strong></div>
    <div class="col">Overdue: <strong>{{ $overdue }}</strong></div>
</div>

<div class="card p-3">
    <canvas id="taskChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('taskChart'), {
    type: 'pie',
    data: {
        labels: ['Todo', 'Progress', 'Done'],
        datasets: [{
            data: [
                {{ $statusChart['todo'] }},
                {{ $statusChart['progress'] }},
                {{ $statusChart['done'] }}
            ]
        }]
    }
});
</script>

@endsection
