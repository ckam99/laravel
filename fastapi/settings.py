

DATABASE_URL = 'sqlite://db.sqlite3'
DATABASE_GENERATE_SCHEMAS = True
DATABASE_REGISTER_MODELS = [
    'models.base'
]  # or use core.models.auto_load_models()

RABBITMQ_HOST = 'rabbitmq'
RABBITMQ_PORT = 5672
RABBITMQ_USER = 'guest'
RABBITMQ_PASSWORD = 'guest'
