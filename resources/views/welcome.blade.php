<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ExamGenerator</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                <a href="{{ url('/') }}">Home</a>
            </div>

            <div class="content">
                <div class="title m-b-md">
                    ExamGenerator
                </div>

                <div class="links">
                    <form action="{{ url('/') }}" method="get" target="_blank">
                        Cantidad de temas:<input type="number" name="temas" min="1" max="5"><br>
                        Cantidad de preguntas: <input type="number" name="preguntas" min="1" max="40"><br>
                        <input type="submit" value="Generar exámen">
                        </form>
                 <!--   <button onClick="">Generar exámen</button>  -->
                    <a href="{{ url('examen') }}">Examen generado</a>
                </div>
            </div>
            <?php
                if (isset($_GET['temas']) && isset($_GET['preguntas'])) {
                    require_once __DIR__.'/../../../app/ExamGenerator.php';
                    require_once __DIR__.'/../../../app/Questions.php';
    
                    $examGenerator = new Generator\ExamGenerator;
    
                    $examGenerator->loadQuestions(__DIR__.'/../../../resources/yaml/preguntas.yml');
                    
                    // despues esta variable se podria usar para pasarsela como argumento
                    // a una funcion JavaScript que se ejecute cuando se presione el
                    // boton "Generar exámen" del Html, y entonces el JS toma el argumento
                    // y hace un getFileByName('multiplechoice').write(examenHtml) ponele
                    $examGenerator->setCantidadTemas($_GET['temas']);
                    $examGenerator->saveQuestions(
                        __DIR__.'/../../../public/testing',
                        '.html'
                    );
                }
            ?>    
            
        </div>
    </body>
</html>
