    <html>

    <body>
        <div class="cajafuera" align="center">

            <div class="formulariocaja">
                <form method="post" action="{{Route('login')}}" name="vaidrollteam">
                    @csrf
                    <div class="formtitulo">Login</div>
                    <div align="left" class="textoscajas">&#128273; Ingresar Correo</div>
                    <input type="email" id="email" name="email" class="cajaentradatexto" value="{{old('email')}}" require autofocus autocomplete="username">
                    <div align="left" class="textoscajas">
                        &#128274; Ingresar Contraseña
                    </div>
                    <input type="password" name="password"class="cajaentradatexto" id="password" require autocomplete="current-password"> <br>
                    @if(Route::has('password.request'))
                    <a href="{{route('password.request')}}">
                        Recuperar Contraseña?
                    </a>
                    @endif
                    <x-primary-button class="botonenviar">
                        LOG IN
                    </x-primary-button>
                    
            </div>
            <div>¿Necesitas una cuenta? <a href="#">Registrar</a></div>
            </form>
        </div>
        <div class="autor">
            © 2021 Formulario Login. Todos los derechos reservados | Diseño de VaidrollTeam
            <div>
            </div>
    </body>
    <style>
        * {
            box-sizing: border-box;
            font-family: sans-serif;
            color: black;

        }

        body {
            margin: 0;
            padding: 0;
            background: #f2f2f2;
        }

        .cajafuera {
            width: 100vw;
            height: 100vh;
            display: grid;
            overflow: hidden;
            background: rgb(2, 0, 36);
            background: linear-gradient(140deg, rgba(2, 0, 36, 1) 0%, rgba(9, 9, 121, 1) 35%, rgba(5, 100, 181, 1) 64%, rgba(0, 212, 255, 1) 100%);

        }

        .formulariocaja {
            background-color: #f3f3f3;
            width: 400px;
            height: auto;
            position: relative;
            margin: auto;
            padding: 1em;
            border-radius: 5px;
            color: white;
            border: 0.1em solid black;
        }

        input {
            display: block;
            text-align: left;
            box-sizing: border-box;
        }

        .cajaentradatexto {
            width: 80%;
            padding: 10px;
            font-size: 1em;
            border-radius: 5px;
            border: 1px solid black;
            color: black;
            font-weight: bold;
        }

        .formtitulo {
            font-size: 2em;
            font-weight: bold;
            padding-bottom: 0.8em;
            color: black;
        }

        a {
            text-decoration: none;
            cursor: pointer;
            color: #1A3A83;
            font-weight: bold;
        }

        .af {
            margin-right: 10%;
            margin-top: 5%;
        }

        .botonenviar {
            width: 80%;
            padding: 10px 30px;
            cursor: pointer;
            display: block;
            margin-top: 10px;
            border: 0;
            outline: none;
            border-radius: 10px;
            border: 1px solid black;
            font-size: 16px;
            color: white;
            background-color: #6D26D3;
            text-align: center;
            margin: 5%;
            font-weight: bold;
        }

        img {
            width: 150px;
        }

        .imgv {
            padding: 20px;
        }

        .imgv img {
            cursor: pointer;
            max-width: 20%;
            height: auto;
            margin-right: 10px;
            margin-left: 10px;
        }

        .textoscajas {
            margin-left: 8%;
            font-weight: bold;
            margin-top: 2%;
            margin-bottom: 2%;
            color: black
        }

        .autor {
            color: white;
        }
    </style>

    </html>