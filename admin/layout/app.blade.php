<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">Admin Panel</span>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-light">Dashboard</a>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>