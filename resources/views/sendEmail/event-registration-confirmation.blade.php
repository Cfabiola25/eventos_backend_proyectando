<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmación de Registro</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #e90019, #ff4757);
            color: white;
            padding: 35px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: bold;
        }
        .header p {
            margin: 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .content {
            padding: 35px 30px;
            background: white;
        }
        .event-card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #e90019;
        }
        .event-title {
            color: #e90019;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 12px;
        }
        .event-info {
            color: #6c757d;
            margin-bottom: 8px;
        }
        .event-info strong {
            color: #495057;
        }
        .footer {
            margin-top: 35px;
            padding-top: 25px;
            border-top: 1px solid #e9ecef;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .note {
            background: #fff5f5;
            border: 1px solid #ffcccc;
            border-radius: 8px;
            padding: 20px;
            margin-top: 25px;
            font-style: italic;
            color: #721c24;
        }
        .note strong {
            color: #e90019;
        }
        .greeting {
            color: #495057;
            margin-bottom: 20px;
        }
        .section-title {
            color: #e90019;
            font-size: 20px;
            font-weight: bold;
            margin: 25px 0 15px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #f8f9fa;
        }
        .capacity-info {
            background: #e9ecef;
            padding: 8px 12px;
            border-radius: 4px;
            margin-top: 10px;
            font-size: 14px;
            color: #495057;
        }
        .capacity-info strong {
            color: #e90019;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            color: #856404;
        }
        .warning strong {
            color: #e90019;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Confirmación de Registro</h1>
            <p>¡Tu registro ha sido exitoso!</p>
        </div>
        
        <div class="content">
            <div class="greeting">
                <p>Hola <strong style="color: #e90019;">{{ $emailData['user']['name'] }}</strong>,</p>
            </div>
            
            <p style="color: #495057; margin-bottom: 25px;">Te confirmamos que tu registro a los siguientes eventos ha sido procesado exitosamente:</p>
            
            <h3 class="section-title">Eventos Registrados ({{ $emailData['total_events'] }})</h3>
            
            @foreach($emailData['registered_events'] as $event)
            <div class="event-card">
                <div class="event-title">{{ $event['event_title'] }}</div>
                <div class="event-info">
                    <strong>ID de Registro:</strong> {{ $event['registration_uuid'] }}
                </div>
                <div class="event-info">
                    <strong>Fecha de Registro:</strong> {{ \Carbon\Carbon::parse($event['registered_at'])->format('d/m/Y H:i') }}
                </div>
            </div>
            @endforeach
            
            <!-- 👇 INICIO: NOTA SOBRE CAMBIOS EN LA PROGRAMACIÓN -->
            <div class="note">
                <p><strong>📝 Nota importante:</strong></p>
                <p>Esta programación de eventos puede estar sujeta a cambios. Te recomendamos verificar la información actualizada en nuestra plataforma antes de cada evento.</p>
            </div>
            <!-- 👆 FIN: NOTA SOBRE CAMBIOS EN LA PROGRAMACIÓN -->
            
            <p style="color: #495057; margin: 25px 0 15px 0;">Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos.</p>
            
            <p style="color: #e90019; font-weight: bold; font-size: 16px;">¡Esperamos verte en los eventos!</p>
            
            <!-- 👇 INICIO: MENSAJE DE ADVERTENCIA SOBRE CAMBIOS (AL FINAL) -->
            <div class="warning">
                <p><strong>⚠️ Importante:</strong></p>
                <p>Una vez <strong>recibido</strong> este correo, no será posible realizar cambios en tu registro por parte del usuario. Si necesitas modificar algún dato, por favor contacta al administrador del evento lo antes posible.</p>
            </div>
            <!-- 👆 FIN: MENSAJE DE ADVERTENCIA SOBRE CAMBIOS (AL FINAL) -->
            
            <div class="footer">
                <p>Saludos cordiales,<br>
                <strong style="color: #e90019;">Equipo de {{ config('app.name') }}</strong></p>
                <p style="margin-top: 10px; color: #6c757d;">{{ date('Y') }} - Todos los derechos reservados</p>
            </div>
        </div>
    </div>
</body>
</html>