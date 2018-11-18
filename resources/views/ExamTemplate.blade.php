<!DOCTYPE html>
<html>
  <head>
    <title>Exam</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name=viewport content="width=device-width, initial-scale=1">

    <style>

      .question {
          border: 1px solid gray;
          padding: 0.3em;
      }

      .number {
          float: left;
          margin-right: 0.5em;
          font-weight: bold;
      }

      .options {
          display: flex;
          flex-direction: column;
      }

      .short {
          display: grid;
          grid-template-columns: 1fr 1fr;
          grid-gap: 1em;
      }

      .questions {
          display: grid;
          grid-template-columns: 1fr 1fr;
          grid-gap: 1em 1em;
      }

      .header {
          display: flex;
          justify-content: space-between;
          margin-bottom: 1em;
      }

      .description {
          margin-bottom: 0.5em;
          font-weight: bold;
      }

      body {
        font-size: 12px;
      }

    </style>
  </head>
  <body>
    <div class="header">
      <strong>Nombre y Apellido _____________________________________________ </strong>
      <strong>Evaluación número</strong>
      <strong>TEMA </strong>
    </div>
    <div class="questions">
      
      @yield("preguntas")
      
    </div>
  </body>
</html>
