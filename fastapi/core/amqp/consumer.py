import pika
import json
from models.base import User

params = pika.URLParameters('amqp://guest:guest@rabbitmq:5672')
connection = pika.BlockingConnection(params)

channel = connection.channel()
channel.queue_declare(queue='laravel')

# def publish(method, body):
#     props = pika.BasicProperties(method)
#     channel.basic_publish(exchange='', routing_key='laravel',
#                           body=json.dumps(body), properties=props)

# in your signal your can call methods public('user_created', user)


async def receive(ch, method, props, body):
    print('Receive in main')
    data = json.loads(body)
    if props.content_type == 'user_created':
        user = User(**data)
        await user.save()
    else:
        print('receive', props)


channel.basic_consume(
    queue='laravel', on_message_callback=receive, auto_ack=True)

print('Started consumer')
channel.start_consuming()
channel.channel()
