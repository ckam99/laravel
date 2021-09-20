# import pika
# import uuid
import settings
import json


# class PikaClient:

#     def __init__(self, process_callable):
#         self.publish_queue_name = 'publish_queue'
#         self.connection = pika.BlockingConnection(
#             pika.ConnectionParameters(host=settings.RABBITMQ_HOST)
#         )
#         self.channel = self.connection.channel()
#         self.publish_queue = self.channel.queue_declare(
#             queue=self.publish_queue_name)
#         self.callback_queue = self.publish_queue.method.queue
#         self.response = None
#         self.process_callable = process_callable
#         print('Pika connection initialized')

#     async def consume(self, loop):
#         """Setup message listener with the current running loop"""
#         connection = await connect_robust(host=settings.RABBITMQ_HOST,
#                                           port=settings.RABBITMQ_PORT,
#                                           loop=loop)
#         channel = await connection.channel()
#         queue = await channel.declare_queue('foo_consume_queue')
#         await queue.consume(self.process_incoming_message, no_ack=False)
#         print('Established pika async listener')
#         return connection

#     async def process_incoming_message(self, message):
#         """Processing incoming message from RabbitMQ"""
#         message.ack()
#         body = message.body
#         print('Received message')
#         if body:
#             self.process_callable(json.loads(body))


# class FibonacciRpcClient(object):

#     def __init__(self):
#         self.connection = pika.BlockingConnection(
#             pika.ConnectionParameters('amqp://guest:guest@rabbitmq:5672'))

#         self.channel = self.connection.channel()

#         result = self.channel.queue_declare(queue='', exclusive=True)
#         self.callback_queue = result.method.queue

#         self.channel.basic_consume(
#             queue=self.callback_queue,
#             on_message_callback=self.on_response,
#             auto_ack=True)

#     def on_response(self, ch, method, props, body):
#         if self.corr_id == props.correlation_id:
#             self.response = body

#     def call(self, n):
#         self.response = None
#         self.corr_id = str(uuid.uuid4())
#         self.channel.basic_publish(
#             exchange='',
#             routing_key='rpc_queue',
#             properties=pika.BasicProperties(
#                 reply_to=self.callback_queue,
#                 correlation_id=self.corr_id,
#             ),
#             body=str(n))
#         while self.response is None:
#             self.connection.process_data_events()
#         return int(self.response)

#     def send_message(self, message: dict):
#         """Method to publish message to RabbitMQ"""
#         self.channel.basic_publish(
#             exchange='',
#             routing_key=self.publish_queue_name,
#             properties=pika.BasicProperties(
#                 reply_to=self.callback_queue,
#                 correlation_id=str(uuid.uuid4())
#             ),
#             body=json.dumps(message)
#         )

# # https://itracer.medium.com/rabbitmq-publisher-and-consumer-with-fastapi-175fe87aefe1
# # https://github.com/scalablescripts/python-microservices/blob/main/main/docker-compose.yml
# # https://www.youtube.com/watch?v=SzsPe_QX__c


# class FooApp(FastAPI):

#     def __init__(self, *args, **kwargs):
#         super().__init__(*args, **kwargs)
#         self.pika_client = PikaClient(self.log_incoming_message)

#     @classmethod
#     def log_incoming_message(cls, message: dict):
#         """Method to do something meaningful with the incoming message"""
#         logger.info('Here we got incoming message %s', message)
