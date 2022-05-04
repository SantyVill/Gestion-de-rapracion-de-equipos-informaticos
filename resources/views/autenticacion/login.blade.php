@extends('navegacion')

@section('titulo','Logueo')

@section('contenido')
<div class="container text-center">
    <div class="row">
        <div class="col-4"></div>
        <div class="mr-auto col-4">
            <form class="form-signin" method="POST" action="{{route('login.store')}}">
                @csrf
                <h1 class="h3 mb-3 fw-normal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Por favor, registrese</font></font></h1>
                
                <div class="form-floating">
                    <input  class="form-control" placeholder="nombre@ejemplo.com" type="email" name="email" placeholder="Email" value="{{ old('email')}}" required><br>
                    {{-- <input type="email" class="form-control" id="floatingInput" placeholder="nombre@ejemplo.com"> --}}
                    <label for="floatingInput"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Dirección de correo electrónico</font></font></label>
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
            </form>
        </div>
        <div class="col-4"></div>
    </div>
</div>

@endsection