from fastapi import FastAPI, Request
from fastapi.staticfiles import StaticFiles
from core.database import connect_db
from core.middlewares import register_cors
from routes import users, posts
from core.views import render
from core.amqp.test import main_pika
import asyncio


app = FastAPI()

app.mount('/static', StaticFiles(directory='templates/static'),
          name='static')

app.include_router(users.router)
app.include_router(posts.router)


@app.get('/')
def home(request: Request):
    return render(request, 'index.html')


@app.on_event('startup')
def on_start():
    connect_db(app)
    register_cors(app)
    loop = asyncio.get_event_loop()
    asyncio.ensure_future(main_pika(loop))
