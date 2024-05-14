from flask import Flask, request, jsonify, render_template

app = Flask(__name__)

@app.route('/api/from_laravel', methods=['POST'])
def from_laravel():
    # Obtén los datos enviados desde Laravel
    data = request.json

    # Obtiene el mensaje enviado desde Laravel
    message_from_laravel = data.get('message', '')

    # Imprime el mensaje recibido en la terminal de Flask
    print(f"Mensaje recibido desde Laravel: {message_from_laravel}")

    # Prepara la respuesta para enviar a Laravel
    response_data = {'message': f'Hola desde Flask, recibí tu mensaje: {message_from_laravel}'}

    # Devuelve la respuesta al cliente (Laravel)
    return jsonify(response_data)

@app.route('/')  # Maneja la ruta raíz
def index():
    return render_template('form.html')

@app.route('/send-message', methods=['POST'])  # Maneja la ruta para enviar mensajes
def send_message():
    # Obtén el mensaje enviado desde el formulario
    message = request.form.get('message', '')

    # Aquí puedes agregar la lógica para enviar el mensaje a Laravel si es necesario

    return 'Mensaje enviado: ' + message

# Función para imprimir un mensaje después de que se haya enviado la respuesta
def print_message_sent(response):
    # Verifica si la solicitud proviene de la ruta /send-message
    if request.path == '/send-message':
        # Obtén el mensaje enviado desde el formulario
        message = request.form.get('message', '')

        # Imprime el mensaje enviado desde aquí en la terminal de Flask
        print(f"Mensaje enviado desde aquí: {message}")

    return response

# Aplica la función print_message_sent después de enviar cada respuesta
@app.after_request
def after_request(response):
    return print_message_sent(response)

if __name__ == '__main__':
    app.run(port=5001)
