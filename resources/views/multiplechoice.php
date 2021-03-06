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
      <strong>TEMA 1</strong>
    </div>
    <div class="questions">
      <div class='question'>
        <div class='number'>1)______</div>
        <div class='description'>Los ataques relacionados con suplantar webs de entidades bancarias se relacionan con</div>
        <div class='options short'>
          <div class='option'>A) Ataques de fuerza bruta.</div>
          <div class='option'>B) Phishing.</div>
          <div class='option'>C) Envio masivo de spam.</div>
          <div class='option'>D) Sabotaje de routers.</div>
          <div class='option'>E) Ataques de denegación de servicio.</div>
          <div class='option'>F) Todas las anteriores.</div>
          <div class='option'>G) Ninguna de las anteriores.</div>
        </div>
      </div>
      <div class='question'>
        <div class='number'>2)______</div>
        <div class='description'>Un ataque que involucra el siguiente código &lt;script&gt;window.location='maligno.com'</div>
        <div class='options short'>
          <div class='option'>A) es del tipo inyeccion SQL.</div>
          <div class='option'>B) es del tipo DDOS.</div>
          <div class='option'>C) es del tipo XSS.</div>
          <div class='option'>D) es del tipo CSFR.</div>
          <div class='option'>E) Todas las anteriores.</div>
          <div class='option'>F) Ninguna de las anteriores.</div>
        </div>
      </div>
      <div class='question'>
        <div class='number'>3)______</div>
        <div class='description'>Contratar una poliza de seguro o contratar un proveedor para que se encargue de un riesgo en particular se denomina.</div>
        <div class='options short'>
          <div class='option'>A) Mitigar el riesgo.</div>
          <div class='option'>B) Evitar el riesgo.</div>
          <div class='option'>C) Transferir el riesgo.</div>
          <div class='option'>D) Asumir el riesgo.</div>
          <div class='option'>E) Aceptar el riesgo.</div>
          <div class='option'>F) Todas las anteriores.</div>
          <div class='option'>G) Ninguna de las anteriores.</div>
        </div>
      </div>
      <div class='question'>
        <div class='number'>4)______</div>
        <div class='description'>En cual de los siguientes archivos no es posible inyectar codigo malicioso</div>
        <div class='options short'>
          <div class='option'>A) .doc</div>
          <div class='option'>B) .pdf</div>
          <div class='option'>C) .xls</div>
          <div class='option'>D) .jpg</div>
          <div class='option'>E) .exe</div>
          <div class='option'>F) Ninguna de las anteriores.</div>
        </div>
      </div>
      <div class='question'>
        <div class='number'>5)______</div>
        <div class='description'>Los programas maliciosos cuyo fin principal es propagarse lo más rápidamente posible por las redes se denomina.</div>
        <div class='options short'>
          <div class='option'>A) Ransonware.</div>
          <div class='option'>B) Virus.</div>
          <div class='option'>C) Rootkits.</div>
          <div class='option'>D) Troyanos.</div>
          <div class='option'>E) Gusanos.</div>
          <div class='option'>F) Todas las anteriores.</div>
          <div class='option'>G) Ninguna de las anteriores.</div>
        </div>
      </div>
      <div class='question'>
        <div class='number'>6)______</div>
        <div class='description'>Un ataque que involucra el siguiente código ' OR 1=1'</div>
        <div class='options short'>
          <div class='option'>A) es del tipo CSFR.</div>
          <div class='option'>B) es del tipo inyeccion SQL.</div>
          <div class='option'>C) es del tipo DDOS.</div>
          <div class='option'>D) es del tipo XSS.</div>
          <div class='option'>E) Todas las anteriores.</div>
          <div class='option'>F) Ninguna de las anteriores.</div>
        </div>
      </div>
      <div class='question'>
        <div class='number'>7)______</div>
        <div class='description'>Aquellos códigos maliciososo que pueden modificar el propio código del núcleo del sistema operativo se denominan.</div>
        <div class='options short'>
          <div class='option'>A) Troyanos.</div>
          <div class='option'>B) Rootkits.</div>
          <div class='option'>C) Virus de Macro.</div>
          <div class='option'>D) Ransonware.</div>
          <div class='option'>E) Gusanos.</div>
          <div class='option'>F) Todas las anteriores.</div>
          <div class='option'>G) Ninguna de las anteriores.</div>
        </div>
      </div>
      <div class='question'>
        <div class='number'>8)______</div>
        <div class='description'>La defensa en profundidad consiste en</div>
        <div class='options long'>
          <div class='option'>A) evitar el hackeo por parte de los script-kiddies.</div>
          <div class='option'>B) instalar varios antivirus para aumementar la protección de datos.</div>
          <div class='option'>C) colocar los data-centers en subsuelos.</div>
          <div class='option'>D) asegurar los cables subterraneos.</div>
          <div class='option'>E) definir varias capas de protecion para las comunicaciones de internet.</div>
          <div class='option'>F) Ninguna de las anteriores.</div>
        </div>
      </div>
      <div class='question'>
        <div class='number'>9)______</div>
        <div class='description'>Los activos a proteger de un sistema informatico se denominan</div>
        <div class='options short'>
          <div class='option'>A) Impactos</div>
          <div class='option'>B) Amenazas</div>
          <div class='option'>C) Recursos</div>
          <div class='option'>D) Vulnerabilidades</div>
          <div class='option'>E) Riesgos</div>
          <div class='option'>F) Todas las anteriores.</div>
          <div class='option'>G) Ninguna de las anteriores.</div>
        </div>
      </div>
      <div class='question'>
        <div class='number'>10)______</div>
        <div class='description'>Generalmente el primer paso de un ataque informatico es</div>
        <div class='options short'>
          <div class='option'>A) Elimininar las pruebas que revelan el ataque.</div>
          <div class='option'>B) Comprometer el sistema.</div>
          <div class='option'>C) Explorar vulnerabilidades detectadas.</div>
          <div class='option'>D) Buscar vulnerabilidades en el sistema.</div>
          <div class='option'>E) Descubir y explorar el sistema informatico.</div>
          <div class='option'>F) Todas las anteriores.</div>
          <div class='option'>G) Ninguna de las anteriores.</div>
        </div>
      </div>
    </div>
  </body>
</html>
