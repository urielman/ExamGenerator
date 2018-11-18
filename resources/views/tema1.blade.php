@inject('examGenerator', 'Generator')

@section('preguntas')
    {{--el for muestra todas las preguntas--}}
    @for ($i = 1; $i <= 10; $i++)
    <div class='question'>
        <div class='number'>{{$i}})______</div>
    <div class='description'>{{$preguntas['descripcion']}}</div>
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
    @endfor
@endsection