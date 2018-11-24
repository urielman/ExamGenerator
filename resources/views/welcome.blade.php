<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        
        <!-- Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

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
                        <div class="form-group">
                            <label for="exampleSelect2">Cantidad de temas:</label>
                            <select class="form-control" name="temas" id="exampleSelect1">                                        
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="example-number-input" >Cantidad de preguntas:</label>
                            <input class="form-control" type="number" value="10" name="preguntas" id="example-number-input">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ingrese el archivo:</label>
                            <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                            <small id="fileHelp" class="form-text text-muted">El archivo debe tener la extension .yml, conteniendo las preguntas del Examen.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Generar Examenes</button>
                    </form>
                 <!--   <button onClick="">Generar exámen</button>  -->
                    <br><br>
                    <a href="{{ url('examen') }}">Examen Ejemplo</a>
                </div>
            </div>
            <?php
                if (isset($_GET['temas']) && isset($_GET['preguntas'])) {
                    require_once __DIR__.'/../../../app/ExamGenerator.php';
                    require_once __DIR__.'/../../../app/Questions.php';
    
                    $examGenerator = new Generator\ExamGenerator;
    
                    $examGenerator->loadQuestions(__DIR__.'/../../../resources/yaml/preguntas.yml');
                    
                    $examGenerator->setCantidadTemas($_GET['temas']);
                    $examGenerator->setCantidadDePreguntas($_GET['preguntas']);

                    $examGenerator->saveQuestions();
                }
            ?>    
            
        </div>
    </body>
</html>
