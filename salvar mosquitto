import paho.mqtt.client as mqtt
import mysql.connector

# Configurações do broker MQTT
broker_host = "localhost"
broker_port = 1883

# Cria um cliente MQTT
client = mqtt.Client()

# Conecta-se ao broker MQTT
client.connect(broker_host, broker_port)

# Cria uma conexão com o banco de dados MySQL
connection = mysql.connector.connect(user='root', password='123321@', host='127.0.0.1',port=3306,database='meu_banco',
auth_plugin='mysql_native_password')

# Cria um cursor para executar comandos SQL
cursor = connection.cursor()

# Define um callback para ser chamado quando uma mensagem MQTT for recebida
def on_message(client, userdata, message):
    # Obtém o valor da mensagem
    value = message.payload.decode()

    # Formata os dados
    values = value.split(",")

    # Insere os dados no banco de dados
    cursor.execute(f"""
        INSERT INTO dados (h2s, metano, temperatura, vazao)
        VALUES ({values[0]}, {values[1]}, {values[2]}, {values[3]})
        """)
    connection.commit()

# Registra o callback
client.on_message = on_message

# Subscreve-se a um tópico
client.subscribe("dados")

# Inicia um loop infinito para receber mensagens
client.loop_forever()