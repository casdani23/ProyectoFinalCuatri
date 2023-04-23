<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>Roles</title>
</head>
<body>
    <div class="app">
		<div class="menu-toggle">
			<div class="hamburger">
				<span></span>
			</div>
		</div>

		<aside class="sidebar">
			<h3>Menu</h3>
			
			<nav class="menu">
				<a href="{{ route('Dashboard/User.index') }}" class="menu-item">Users</a>
				@can('/Dashboard/Roles.index')
				<a href="{{ route('Dashboard/Roles.index') }}" class="menu-item">Roles</a>
				@endcan
                <a href="{{ route('Dashboard/Products.index') }}" class="menu-item">Products</a>
				@can('/Dashboard/SupervisorToken.index')
				<a href="{{ route('Dashboard/SupervisorToken.index') }}" class="menu-item">Token</a>
				@endcan
				<form method="POST" action="{{ route('logout') }}" style="margin-left: 18px">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
			</nav>

		</aside>

		<main class="content">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
            <h1>Bienvenido</h1>
            
            @yield('contenido')

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
		</main>
	</div>

	<script>
		const menu_toggle = document.querySelector('.menu-toggle');
		const sidebar = document.querySelector('.sidebar');

		menu_toggle.addEventListener('click', () => {
			menu_toggle.classList.toggle('is-active');
			sidebar.classList.toggle('is-active');
		});
	</script>
</body>
</html>