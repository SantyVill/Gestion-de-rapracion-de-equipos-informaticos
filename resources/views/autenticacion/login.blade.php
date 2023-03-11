<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <title>Logueo</title>
</head>
<body>
    <header>
        <h1 class="text-center">Gestion de reparaciones</h1>




    </header>
    <div class="container text-center mt-4">
        <div class="row">
            <div class="col-7 position-relative top-50 ">
                <img width="350" height="350" src="https://www.facet.unt.edu.ar/wp-content/uploads/2022/03/FACET-logo.jpg" class="attachment-1200x1200 size-1200x1200" alt="" decoding="async" loading="lazy">
            </div>
            <div class="mr-auto col-4 mt-4">
                <form class="form-signin" method="POST" action="{{route('login.store')}}">
                    @csrf
                    <h2 class="h4 mb-3 fw-normal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Por favor correo electrónico y contraseña</font></font></h2>
                    
                    <div class="form-floating">
                        <input  class="form-control" placeholder="nombre@ejemplo.com" type="email" name="email" placeholder="Email" value="{{session()->has('emailA')?session()->get('emailA'):''}}" required><br>
                        <label for="email"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Dirección de correo electrónico</font></font></label>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" type="password" name="password" placeholder="Contraseña" required placeholder="Clave"><br>
                        {{-- <input type="password" class="form-control" id="floatingPassword" placeholder="Clave"> --}}
                        <label for="floatingPassword"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Clave</font></font></label>
                    </div>
                    
                    {{-- <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Acuérdate de mí
                            </font></font></label>
                        </div> --}}
                        <button class="w-100 btn btn-lg btn-primary" type="submit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Iniciar sesión</font></font></button>
                        {{-- <p class="mt-5 mb-3 text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">© 2017–2021</font></font></p> --}}
                        <div><a class="w-100 btn btn-sm btn-outline-primary mt-1 " href="{{route('password.request')}}">Restablecer Contraseña</a></div>
                </form>
            </div>
        </div>
    </div>


    {{-- <section class="pb-4">
        <div class="bg-white border rounded-5">
          
          <section class="w-100 px-4 py-5 gradient-custom" style="border-radius: .5rem .5rem 0 0;">
            <style>
              .gradient-custom {
                /* fallback for old browsers */
                background: #6a11cb;
      
                /* Chrome 10-25, Safari 5.1-6 */
                background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
      
                /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
              }
            </style>
            <div class="row d-flex justify-content-center">
              <div class="col-12 col-md-8 col-lg-6 col-xl-6">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                  <div class="card-body p-5 text-center">
      
                    <div class="mb-md-5 mt-md-4 pb-5">
      
                      <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                      <p class="text-white-50 mb-5">Please enter your login and password!</p>
      
                      <div class="form-outline form-white mb-4">
                        <input type="email" id="typeEmailX" class="form-control form-control-lg">
                        <label class="form-label" for="typeEmailX" style="margin-left: 0px;">Dirección de correo electrónico</label>
                      <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 40px;"></div><div class="form-notch-trailing"></div></div></div>
      
                      <div class="form-outline form-white mb-4">
                        <input type="password" id="typePasswordX" class="form-control form-control-lg">
                        <label class="form-label" for="typePasswordX" style="margin-left: 0px;">Contraseña</label>
                      <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 64.8px;"></div><div class="form-notch-trailing"></div></div></div>
      
                      <button class="btn btn-outline-light btn-lg px-5" type="submit">Iniciar Sesión</button>
      
      
                    </div>
      
      
                  </div>
                </div>
              </div>
            </div>
          </section>
          
          
          
          <div class="p-4 text-center border-top mobile-hidden">
            <a class="btn btn-link px-3" data-mdb-toggle="collapse" href="#example6" role="button" aria-expanded="false" aria-controls="example6" data-ripple-color="hsl(0, 0%, 67%)">
              <i class="fas fa-code me-md-2"></i>
              <span class="d-none d-md-inline-block">
                Show code
              </span>
            </a>
            
            
              <a class="btn btn-link px-3 " data-ripple-color="hsl(0, 0%, 67%)">
                <i class="fas fa-file-code me-md-2 pe-none"></i>
                <span class="d-none d-md-inline-block export-to-snippet pe-none">
                  Edit in sandbox
                </span>
              </a>
            
          </div>
          
          
        </div>
      </section> --}}


      @if (session()->has('message'))
      <div class="alert alert-warning alert-dismissible" role="alert">
          <strong>{{ session()->get('message') }}</strong> {{ session('success') }}
      </div>
    @endif
</body>
</html>