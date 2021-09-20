import pika
import json


params = pika.URLParameters('amqp://guest:guest@rabbitmq:5672')
connection = pika.BlockingConnection(params)

channel = connection.channel()


def publish(method, body):
    props = pika.BasicProperties(method)
    channel.basic_publish(exchange='', routing_key='laravel',
                          body=json.dumps(body), properties=props)

# in your signal your can call methods public('user_created', user)
#   queue:
#     build: fastapi
#     command: 'python -u consumer.py'
#     depends_on:
#       - db
