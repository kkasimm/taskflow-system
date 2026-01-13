@extends('admin.layout.app')

@section('content')

<h1>Admin Dashboard</h1>

<div>
    <p>Total Users: {{ $totalUsers }}</p>
    <p>Total Tasks: {{ $totalTasks }}</p>
    <p>Todo: {{ $todo }}</p>
    <p>Progress: {{ $progress }}</p>
    <p>Done: {{ $done }}</p>
    <p>Overdue: {{ $overdue }}</p>
</div>

<canvas id="taskStatusChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('taskStatusChart'), {
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
