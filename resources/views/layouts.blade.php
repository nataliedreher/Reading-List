<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="css/app.css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                    <ul class="navbar-nav">
                            <li class="nav-item">
                              <a class="nav-link" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="/reading-list">Reading List</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="/add">Add Book</a>
                            </li>
                          </ul>
                    <form class="form-inline" action="/action_page.php">
                      <input class="form-control mr-sm-2" type="text" placeholder="Search">
                      <button class="btn btn-success" type="submit">Search</button>
                    </form>
                  </nav>
                  <br>
      @yield('content')

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </body>
</html>
