import paho.mqtt.client as mqtt
import mysql.connector

# Configurações do broker MQTT
broker_host = "test.mosquitto.org"
broker_port = 1883

# Cria uma conexão com o banco de dados MySQL
connection = mysql.connector.connect(user='root', password='123321@', host='127.0.0.1', port=3306, database='teste',
                                     auth_plugin='mysql_native_password')

# Cria um cursor para executar comandos SQL
cursor = connection.cursor()

# Callback chamado quando uma mensagem MQTT é recebida
def on_message(client, userdata, message):
    # Obtém o valor da mensagem
    value = message.payload.decode()

    # Formata os dados
    values = value.split(",")

    # Tenta converter a substring para float
    try:
        alcohol_value = float(values[0])
    except ValueError:
        print("Erro ao converter para float:", values[0])
        return

    # Insere os dados no banco de dados
    cursor.execute(f"""
        INSERT INTO dados (alcool)
        VALUES ({alcohol_value})
        """)
    connection.commit()

# Cria o cliente MQTT
client = mqtt.Client()

# Conecta-se ao broker MQTT
client.connect(broker_host, broker_port)

# Define o ID do cliente
client.client_id = "esp32_mqtt_IF23JF"

# Subscreve-se ao tópico
client.subscribe("topico_sensor_alcool_if23JF")

# Define o callback para mensagens
client.on_message = on_message

# Inicia o loop infinito para receber mensagens
client.loop_forever()