<x-app-layout>
<!DOCTYPE html>
<html>
<head>
    <title>Create Plan</title>
</head>
<body>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('plan.store') }}" method="POST">
        @csrf
        <label>Title:</label>
        <input type="text" name="title" required><br><br>

        <label>Description:</label>
        <textarea name="description"></textarea><br><br>

        <button type="submit">Create Plan</button>
    </form>
</body>
</html>

</x-app-layout>
