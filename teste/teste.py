from fastapi import FastAPI, HTTPException
from pydantic import BaseModel, EmailStr, Field
from typing import List

app = FastAPI(title="Mini User API")

class UserCreate(BaseModel):
    name: str = Field(..., min_length=1)
    email: EmailStr
    password: str = Field(..., min_length=4)

class User(BaseModel):
    id: int
    name: str
    email: EmailStr

users_db = [
    {"id": 1, "name": "Carlos", "email": "carlos@example.com", "password": "senha123"},
    {"id": 2, "name": "Mariana", "email": "mariana@example.com", "password": "senha456"}
]
next_id = 3

@app.get("/")
async def root():
    return {
        "message": "Mini API de cadastro de usuários",
        "docs": "/docs",
        "count": len(users_db)
    }

@app.post("/users", response_model=User, status_code=201)
async def create_user(user: UserCreate):
    global next_id
    for existing in users_db:
        if existing["email"] == user.email:
            raise HTTPException(status_code=400, detail="Email já cadastrado")

    new_user = {
        "id": next_id,
        "name": user.name,
        "email": user.email,
        "password": user.password
    }
    users_db.append(new_user)
    next_id += 1
    return {"id": new_user["id"], "name": new_user["name"], "email": new_user["email"]}

@app.get("/users", response_model=List[User])
async def list_users():
    return [{"id": user["id"], "name": user["name"], "email": user["email"]} for user in users_db]

@app.get("/users/{user_id}", response_model=User)
async def get_user(user_id: int):
    for user in users_db:
        if user["id"] == user_id:
            return {"id": user["id"], "name": user["name"], "email": user["email"]}
    raise HTTPException(status_code=404, detail="Usuário não encontrado")

@app.delete("/users/{user_id}", status_code=204)
async def delete_user(user_id: int):
    for index, user in enumerate(users_db):
        if user["id"] == user_id:
            users_db.pop(index)
            return
    raise HTTPException(status_code=404, detail="Usuário não encontrado")
