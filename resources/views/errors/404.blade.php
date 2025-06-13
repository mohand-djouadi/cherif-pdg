<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href ="{{ asset('img/logomounchaat2.JPG') }}" type = "image/x-icon">

    {{-- <title>AdminLTE 3 | Dashboard</title> --}}


    @include('layouts/admin/styles')
</head>

<body class=" ">
    <div class="">

        <div class="d-flex justify-content-center align-items-center " style="width: 100% ; height: 100vh;">
            <section class="">
              <div class="error-page"  style="">
                <h2 class="headline text-warning">404</h2>
                <div class="error-content">
                  <h3><i class="fas fa-exclamation-triangle fa-bounce text-warning "></i> Oups ! Page non trouvée.</h3>
                  <p>
                    Nous n'avons pas pu trouver la page que vous cherchiez.
                    Pendant ce temps, vous pouvez <a href="/">retourner à la page d'accueil</a>
                  </p>
                </div>
              </div>
            </section>
          </div>

    @include('layouts/admin/scripts')
</div>
</body>

</html>
