<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diploma FESC - {{ $user->first_name }} {{ $user->last_name }}</title>
    <style>

        /*
            En las imágenes se usa public_path para la generación del PDF.
            Si se desea usar una imagen local (por ejemplo, en el navegador), se debe cambiar por asset().
            Ruta recomendada: public/images/
            Se recomienda usar imágenes .webp para mejor compresión y calidad.
        */

        /* Define el tamaño de la hoja y orientación horizontal para el PDF */
        @page {
            /*Para ajustarlo a tamaño carta */
            size: letter landscape;

            /* Para ajustarlo a tamaño oficio*/
            /*size: legal landscape;*/

            margin: 0;
        }

        /* Reinicio de estilos básicos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Ocupa el 100% del alto disponible */
        .h-full { height: 100%; }

        /* Estilos generales del body */
        body {
            background-color: #fff;
            height: 100vh;
            overflow: hidden;
            font-family: "Calibri";
        }

        /* Contenedor principal del diploma */
        .principal-container {
            width: 100%;
            height: 100vh;
            margin: 0;
            background-color: #fff;
        }

        /* Contenedor donde se dibuja el contenido del diploma */
        .contenedor-diploma {
            width: 100%;
            height: 100vh;
            position: relative;
            background-color: #fff;
        }

        /* -------------------------
        Esquinas decorativas
        -------------------------- */

        /* Posiciona una imagen en la esquina superior derecha */
        .esquina-superior-derecha {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 40;
        }

        /* Posiciona una imagen en la esquina superior izquierda */
        .esquina-superior-izquierda {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 40;
        }

        /* -------------------------
        Logos institucionales
        -------------------------- */

        /* Centra el logo de la FESC en la parte superior */
        .logo-fesc-proyectando {
            position: absolute;
            top: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 50;
        }

        /* Tamaño del logo */
        .logo-fesc-proyectando img {
            width: 22rem;
            height: auto;
        }

        /* Logo vertical del Ministerio de Educación */
        .logo-mineducacion {
            position: absolute;
            top: 25%;
            left: -2.75rem;
            transform: translateY(-50%) rotate(-90deg);
            z-index: 50;
        }

        .logo-mineducacion span {
            font-size: 8px;
            font-weight: bold;
            color: #1f2937;
            background-color: #fff;
            padding: 2px 0px;
            border-top: 0.75px solid #1f2937;
            border-bottom: 0.75px solid #1f2937;
            font-family: "Arial", sans-serif;
            letter-spacing: 0.75px;
        }

        .logo-corpomix {
            position: absolute;
            bottom: 0.35%;
            left: 29rem;
            z-index: 50;
        }

        .logo-corpomix img {
            width: 8rem;
        }

        .logo-promocion-turistica {
            position: absolute;
            bottom: -6%;
            left: 13.5rem;
            z-index: 50;
        }

        .logo-promocion-turistica img {
            width: 12rem;
        }

        .logo-comfanorte {
            position: absolute;
            bottom: 0.5%;
            right: 10%;
            z-index: 50;
        }

        .logo-comfanorte img {
            width: 6rem;
        }

        .logo-alcaldia-pamplona {
            position: absolute;
            bottom: 1.55%;
            z-index: 50;
            right: 24.25%;
        }

        .logo-alcaldia-pamplona img {
            width: 8rem;
        }

        .logo-secretaria-turismo {
            position: absolute;
            bottom: -1.25%;
            left: 5.25rem;
            z-index: 50;
        }

        .logo-secretaria-turismo img {
            width: 6rem;
        }

        /* -------------------------
        Fondos decorativos
        -------------------------- */

        /* Fondo del diploma esquina inferior izquierda */
        .fondo-inferior-izquierda {
            position: absolute;
            bottom: -3.5rem;
            left: -4.5rem;
            z-index: 10;
        }

        .fondo-inferior-izquierda img{
            width: 15rem;
        }

        /* Fondo del diploma esquina inferior derecha */
        .fondo-inferior-derecha {
            position: absolute;
            bottom: -10rem;
            right: 3rem;
            z-index: 10;
        }

        .fondo-inferior-derecha img{
            width: 15rem;
            transform: rotate(-30deg);
        }

        /* Fondo del diploma esquina superior derecha */
        .fondo-superior-derecha {
            position: absolute;
            top: 5rem;
            right: -7.5rem;
            z-index: 10;
        }

        .fondo-superior-derecha img{
            width: 15rem;
        }

        /* -------------------------
        Contenido del diploma
        -------------------------- */

        /* Contenedor del contenido principal: centrado vertical y horizontal */
        .contenido-principal {
            position: relative;
            z-index: 30;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }

        /* Agrupador del contenido textual del diploma */
        .contenido-diploma {
            position: relative;
            z-index: 20;
            width: 100%;
            height: 100%;
        }

        /* -------------------------
        Textos del diploma
        -------------------------- */

        /* Título superior del diploma */
        .titulo-principal {
            position: absolute;
            top: 10.5rem;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            font-size: 1.25rem;
            line-height: 1.5rem;
            color: #1f2937;
            width: 70%;
            font-weight: 550;
        }

        /* Texto "Certifican que..." */
        .certifican {
            position: absolute;
            top: 14.5rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.75rem;
            line-height: 2rem;
            text-align: center;
            color: #1f2937;
            width: 100%;
            font-style: italic;
        }

        /* Nombre del participante */
        .nombre {
            position: absolute;
            top: 17rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: 3rem;
            /* Este cambio fue el ultimo cambio que se hizo para el correcto funcionamiento de los nombres dinamicos */
            width: 80%;
            text-align: center;
            color: #000;
            border-bottom: 3px solid #1f2937;
            font-style: italic;
            font-weight: 500;
        }

        /* Documento del participante */
        .documento {
            position: absolute;
            top: 21rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.75rem;
            line-height: 1.75rem;
            text-align: center;
            color: #1f2937;
            width: 100%;
        }

        /* Texto introductorio del evento */
        .asistio {
            position: absolute;
            top: 23.5rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.25rem;
            line-height: 1.75rem;
            color: #1f2937;
            text-align: center;
            width: 85%;
            font-style: italic;
        }

        /* Nombre del evento */
        .nombre-evento {
            position: absolute;
            top: 27rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: 3.25rem;
            line-height: 1.1;
            text-align: center;
            color: #000;
            font-weight: 300;
            width: 95%;
        }

        /* Participación o rol */
        .participacion {
            position: absolute;
            top: 31rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.5rem;
            line-height: 1.75rem;
            text-align: center;
            color: #1f2937;
            width: 90%;
            font-style: italic;
        }

        /* Fecha del evento */
        .fecha-realizacion {
            position: absolute;
            top: 35rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1rem;
            line-height: 1.5rem;
            text-align: center;
            color: #1f2937;
            width: 90%;
            font-style: italic;
        }

        /* -------------------------
        Firma
        -------------------------- */

        /* Contenedor del nombre de quien firma */
        .contenedor-firma {
            position: absolute;
            top: 44rem;
            left: 50%;
            transform: translateX(-50%);
            width: 20rem;
            text-align: center;
        }

        /* Evita salto de línea en el nombre */
        .nombre-firma {
            white-space: nowrap;
        }

        /* Aplica línea superior y formato al nombre de la firma */
        .nombre-firma strong {
            border-top: 2px solid #000;
            padding-top: 0.5rem;
            display: inline-block;
            font-size: 1.125rem;
        }

        /* Imagen de firma escaneada */
        .imagen-firma {
            position: absolute;
            bottom: 6.5rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 50;
        }

        /* Tamaño de la imagen de firma */
        .firma {
            width: 13.5rem;
            height: auto;
        }

        /* -------------------------
        Ajustes para impresión
        -------------------------- */

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
    </style>
</head>
<body class="h-full">

    <!-- Contenedor principal del diploma -->
    <div class="principal-container h-full">

        <!-- =========== Aqui inicia el contenedor general del diploma =========== -->
        <div class="h-full contenedor-diploma">

            <!-- =========== Aqui inicia el uso de las esquinas decorativas =========== -->

                <!-- Esquina superior derecha -->
                <div class="esquina-superior-derecha">
                    <img src="{{ public_path('images/Right-top-corner.webp') }}" alt="Esquina superior derecha">
                </div>

                <!-- Esquina superior izquierda -->
                <div class="esquina-superior-izquierda">
                    <img src="{{ public_path('images/Left-top-corner.webp') }}" alt="Esquina superior izquierda">
                </div>

            <!-- =========== Aqui finaliza el uso de las esquinas decorativas =========== -->

            <!-- *************************************************************************************** -->

            <!-- =========== Aqui inicia el uso de la imagenes de fondo del diploma =========== -->

            <!-- Fondo del diploma esquina inferior izquierda -->
            <div class="fondo-inferior-izquierda">
                <img src="{{ public_path('images/EJE-01.webp') }}">
            </div>

            <!-- Fondo del diploma esquina inferior derecha -->
            <div class="fondo-inferior-derecha">
                <img src="{{ public_path('images/EJE-02_1.webp') }}">
            </div>

            <!-- Fondo del diploma esquina superior derecha -->
            <div class="fondo-superior-derecha">
                <img src="{{ public_path('images/EJE-03_1.webp') }}">
            </div>
            <!-- *************************************************************************************** -->

            <!-- =========== Aqui inicia el uso de los logos del diploma =========== -->

            <!-- Logo FESC & PROYECTANDO -->
            <div class="logo-fesc-proyectando">
                <img src="{{ public_path('images/LOGO_PROYECTANDO.webp') }}" alt="Logo FESC y Proyectando">
            </div>

            <!-- Logo MinEducacion lateral izquierdo -->
            <div class="logo-mineducacion">
                <span>
                    VIGILADA MINEDUCACIÓN
                </span>
            </div>

            <div class="logo-corpomix">
                <img src="{{ public_path('images/logo_corpomix.webp') }}" alt="Logo CORPOMIX">
            </div>            

            <div class="logo-promocion-turistica">
                <img src="{{ public_path('images/promocion_turistica.webp') }}" alt="Logo PROMOCION TURISTICA">
            </div>

            <div class="logo-alcaldia-pamplona">
                <img src="{{ public_path('images/alcaldia_pamplona.webp') }}" alt="Logo ALCALDIA PAMPLONA">
            </div>

            <div class="logo-secretaria-turismo">
                <img src="{{ public_path('images/secretaria_turismo.webp') }}" alt="Logo SECRETARIA DE TURISMO">
            </div>

            <div class="logo-comfanorte">
                <img src="{{ public_path('images/logo-comfanorte.webp') }}" alt="Logo SECRETARIA DE TURISMO">
            </div>

            <!-- =========== Aqui finaliza el uso de los logos del diploma =========== -->

            <!-- *************************************************************************************** -->

            <!-- =========== Aqui inicia el contenido principal del diploma =========== -->
            <div class="h-full contenido-principal">  

                <!-- Contenido del diploma -->
                <!-- =========== Aqui inicia el contenido de textos para el diploma =========== -->

                <div class="contenido-diploma">
                    <!-- Título principal -->
                    <h1 class="titulo-principal ">
                        La Fundación de Estudios Superiores Comfanorte FESC, con Personería Jurídica: Resolución 04172 del 25 de agosto de 1993
                    </h1>

                    <span class="certifican ">
                        Certifica que:
                    </span>
                    
                    <!-- Nombre del participante -->
                    <!-- Se obtiene el nombre dinamicamente segun la ID del participante -->
                    <h1 class="nombre ">{{ $user->first_name }} {{ $user->last_name }}</h1>

                    <!-- Documento de Identidad del participante-->
                    <!-- Se obtiene el documento dinamicamente segun la ID del participante -->
                    <span class="documento ">
                        D.I. {{ $user->document_number }}
                    </span>
                    
                    <span class="asistio ">
                        Participó en el Panel de Conclusiones titulado "Dinámicas Mundiales que Transforman Nuestra Industria Turística", dentro del marco del
                    </span>
                    
                    <!-- Nombre del evento -->
                    <h1 class="nombre-evento ">V Congreso Internacional Proyectando</h1>

                    <!-- Texto de participación -->
                    <span class="participacion ">
                        "Impulsamos el Desarrollo Turístico y Productivo de Norte de Santander<br>
                        a través de la educación superior."
                    </span>

                    <!-- Fechas de realización -->
                    <h1 class="fecha-realizacion ">
                        Realizado los días 20, 21, 22, 23 y 24 de octubre de 2025 en la ciudad de San José de Cúcuta, Colombia.<br>
                        Se firma a los 10 días del mes de noviembre de 2025.
                    </h1>

                    <!-- =========== Se inicia el contenedor ded uso de la firma en imagen =========== -->
                    <!-- Imagen de la firma -->
                    <div class="imagen-firma">
                        <img src="{{ public_path('images/FIRMA_RECTORA_1.webp') }}" alt="Firma" class="firma">
                    </div>
                    <!-- =========== Aqui finaliza el contendor de la imagen de la firma =========== -->
                    
                    <!-- *************************************************************************************** -->

                    <!-- =========== Aqui inicia el contendor de textos para la firma =========== -->
                    <!-- Contenedor para los textos de firma -->
                    <div class="contenedor-firma">
                        <span class=" nombre-firma">
                            <!-- Nombre de la persona que firma -->
                            <strong>Jaime Fernández Erazo</strong>
                            <br>
                            <!-- Cargo de la persona que firma -->
                            Rector FESC
                        </span>
                    </div> <!-- =========== Aqui finaliza el contendor de textos para la firma =========== -->
                </div> <!-- =========== Aqui finaliza el contenido de textos para el diploma =========== -->
            </div> <!-- =========== Aqui finaliza el contenido principal del diploma =========== -->
        </div> <!-- =========== Aqui finaliza el contenedor general del diploma =========== -->
    </div>
</body>
</html>