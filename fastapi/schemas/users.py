from pydantic import BaseModel, validator
from core.exceptions import CustomException
from typing import Optional
from datetime import datetime
from core.models import email_exists


class UserSchema(BaseModel):
    id: int
    firstname: str
    lastname: str
    email: str
    phone: Optional[str]
    created_at: datetime = None
    modified_at: datetime = None

    class Config:
        orm_mode = True


class UserInSchema(BaseModel):
    lastname: str
    firstname: str
    email: str
    phone: Optional[str]
    password: str

    @validator('password')
    @classmethod
    def validate_password(cls, value):
        if len(value) < 4:
            raise CustomException(
                value, 'Password must be at least 4 characters')
        return value

    @validator('email')
    @classmethod
    def validate_email(cls, value):
        if email_exists(value):
            raise CustomException(
                value, 'Email is not available')
        return value
