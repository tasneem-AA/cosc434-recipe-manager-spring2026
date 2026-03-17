<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Recipe Manager')</title>
</head>
<body>
    <h2> Recipe Manager</h2>

    <nav>
        <a href="{{ route('recipes.index') }}">All Recipes</a>
        @if(session('logged_in'))
          <a href="{{ route('recipes.create') }}">Create Recipe</a>
       
@endif
       <button><a href="/login-demo">Login</a></button>
         <button><a href="/logout-demo">Logout</a></button>
       
    </nav>
    @if(session('success'))
    <div>{{ session('success') }}</div>
    @endif
    @yield('content')

    @if(session('error'))
    <div>{{ session('error') }}</div>
    @endif
    
</body>
</html>