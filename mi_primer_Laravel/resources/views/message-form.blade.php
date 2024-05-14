<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Mensaje a Flask</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            text-align: center; /* Centrar el formulario */
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 50%;
            padding: 10px;
            margin-bottom: 10px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Enviar Mensaje a Flask</h1>
    <form id="messageForm" action="/send-message" method="POST">
        @csrf
        <label for="message">Mensaje:</label><br>
        <input type="text" id="message" name="message"><br><br>
        <button type="submit">Enviar Mensaje</button>
    </form>

    <script>
        document.getElementById('messageForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto
            
            var formData = new FormData(this);
            
            fetch('/send-message', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById('message').value = ''; // Limpiar el campo de mensaje
                } else {
                    alert('Error al enviar el mensaje');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al enviar el mensaje');
            });
        });
    </script>
</body>
</html>
