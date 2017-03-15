<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Worpress Slug Checker</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.3.2/css/bulma.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    </head>
    <body>
<a href="/">
   <section class="hero is-primary">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Wordpress Slug Checker
          </h1>
          <h2 class="subtitle">
            Check the  permalink before setting up 301 redirect to the new url.
          </h2>
        </div>
      </div>
    </section>
</a>
      <section class="section">
        <div id="root" class="container">
          @yield('content')
        </div>
      </section>

      <footer class="footer">
        <div class="container">
          <div class="content has-text-centered">
            <p>
              <strong>Wordpress Slug Checker</strong> by <a href="http://budakgeek.blogspot.com">Hamzah Jamad</a>. The source code is licensed
              <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
              is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC ANS 4.0</a>.
            </p>
            <p>
              <a class="icon" href="https://github.com/hamzahjamad/wordpressslugschecker">
                <i class="fa fa-github"></i>
              </a>
            </p>
          </div>
        </div>
      </footer>

      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
      <script src="https://unpkg.com/vue"></script>
      <script src="js/app.js"></script>
    </body>
</html>
