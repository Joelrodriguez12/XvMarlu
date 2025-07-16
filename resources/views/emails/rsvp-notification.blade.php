<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nueva Confirmación de Asistencia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #e870b8;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .info-row {
            margin: 10px 0;
            padding: 10px;
            background-color: white;
            border-radius: 3px;
        }
        .label {
            font-weight: bold;
            color: #e870b8;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>¡Nueva Confirmación de Asistencia!</h1>
        <p>XV Años de Marlu</p>
    </div>
    
    <div class="content">
        <h2>Detalles de la Confirmación:</h2>
        
        <div class="info-row">
            <span class="label">Nombre:</span> {{ $rsvp->name }}
        </div>
        
        <div class="info-row">
            <span class="label">Teléfono:</span> {{ $rsvp->phone }}
        </div>
        
        <div class="info-row">
            <span class="label">Número de Invitados:</span> {{ $rsvp->guests }}
        </div>
        
        @if($rsvp->message)
        <div class="info-row">
            <span class="label">Mensaje:</span><br>
            {{ $rsvp->message }}
        </div>
        @endif
        
        <div class="info-row">
            <span class="label">Fecha de Confirmación:</span> {{ $rsvp->created_at->format('d/m/Y H:i') }}
        </div>
        
        <hr style="margin: 20px 0;">
        
        <p><strong>Total de confirmaciones hasta ahora:</strong> {{ \App\Models\Rsvp::count() }}</p>
        <p><strong>Total de invitados confirmados:</strong> {{ \App\Models\Rsvp::sum('guests') }}</p>
    </div>
</body>
</html>