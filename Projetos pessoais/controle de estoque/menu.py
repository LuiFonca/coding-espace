


def adicionar(marca, modelo, ano, tamanho, cor, estoque):
    id = gerar_proximo_id()

    conn = conectar()
    cursor = conn.cursor()

    cursor.execute("""
        INSERT INTO bicicletas (id, marca, modelo, ano, tamanho, cor, estoque)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    """, (id, marca, modelo, ano, tamanho, cor, estoque))

    conn.commit()
    conn.close()

    print(f"Bicicleta adicionada com ID {id}")



def novo_id():
    conn = conectar()
    cursor = conn.cursor()

    cursor.execute("SELECT MAX(id) FROM bicicletas")
    resultado = cursor.fetchone()[0]

    conn.close()

    if resultado is None:
        return 1
    return resultado + 1








def remover():
    print("Remover")


def listar_modelos():
    print("listar")





def procurar():
    print("procurar")










while True:

    
    print("""
======Sistema de controle de Estoque=====
              
    1. Adicionar uma nova bicicleta
    2. Remover uma bicicleta
    3. Ver lista dos modelos disponiveis 
    4. Procurar 
              
    0. Sair



""")
        
    opcao_escolhida = input("Escolha uma opção:")

    if opcao_escolhida == "1":
        adicionar()
    elif opcao_escolhida == "2":
        remover()
    elif opcao_escolhida == "3":
        listar_modelos()
    elif opcao_escolhida == "4":
        procurar()
    elif opcao_escolhida == "0":
        break
    else:
        print("Opção invalida, tente novamente.")
      

        

    
