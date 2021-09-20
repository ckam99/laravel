import os
from models.base import User


async def email_exists(email: str):
    cn = await User.filter(email=email).count()
    return cn > 0


async def phone_exists(phone: str):
    cn = await User.filter(phone=phone).count()
    return cn > 0


def auto_load_models():
    files = ['models.{}'.format(x.name.split('.')[0]) for x in os.scandir(
        'models') if x.is_file() and x.name.endswith('.py')]
    return files
