import sqlite3

DB_NAME = "data/bicicletas.db"

def conectar():
   
    conn = sqlite3.connect(DB_NAME)
    return conn


def criar_tabela():
    
    conn = conectar()
    cursor = conn.cursor()

    cursor.execute("""
        CREATE TABLE IF NOT EXISTS bicicletas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            marca TEXT,
            modelo TEXT,
            ano INTEGER,
            tamanho TEXT,
            cor TEXT,
            estoque INTEGER
        )
    """)

    conn.commit()
    conn.close()