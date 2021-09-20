import aio_pika


async def main_pika(loop):
    connection = await aio_pika.connect_robust(
        "amqp://guest:guest@rabbitmq/", loop=loop
    )

    queue_name = "test_queue"

    async with connection:
        # Creating channel
        channel = await connection.channel()
        # Declaring queue
        queue = await channel.declare_queue(queue_name, auto_delete=True)
        async with queue.iterator() as queue_iter:
            async for message in queue_iter:
                async with message.process():
                    print(message.body)

                    if queue.name in message.body.decode():
                        break
