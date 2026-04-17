from database.db import conectar



def adicionar_ou_atualizar_bicicleta(marca, modelo, ano, tamanho, cor, quantidade):
    conn = conectar()
    cursor = conn.cursor()

    # verifica se já existe a bicicleta
    cursor.execute("""
        SELECT id, estoque FROM bicicletas
        WHERE marca = ? AND modelo = ? AND ano = ? AND tamanho = ? AND cor = ?
    """, (marca, modelo, ano, tamanho, cor))

    resultado = cursor.fetchone()

    if resultado:
        # existe -> atualiza estoque
        bike_id, estoque_atual = resultado
        novo_estoque = estoque_atual + quantidade
        cursor.execute("UPDATE bicicletas SET estoque = ? WHERE id = ?", (novo_estoque, bike_id))
        print(f"Estoque atualizado! ID: {bike_id}, novo estoque: {novo_estoque}")
    else:
        # não existe -> cria nova linha
        cursor.execute("""
            INSERT INTO bicicletas (marca, modelo, ano, tamanho, cor, estoque)
            VALUES (?, ?, ?, ?, ?, ?)
        """, (marca, modelo, ano, tamanho, cor, quantidade))
        bike_id = cursor.lastrowid
        print(f"Bicicleta adicionada com ID {bike_id} e estoque {quantidade}")

    conn.commit()
    conn.close()        