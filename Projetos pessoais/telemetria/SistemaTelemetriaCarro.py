import os

# ========= DIVERSOS =========
def limpar_tela():
    os.system("cls" if os.name == "nt" else "clear")


def float_positivo(msg):
    while True:
        try:
            valor = float(input(msg))
            if valor > 0:
                return valor
            else:
                print("Digite um valor maior que zero.")
        except ValueError:
            print("Valor inválido. Digite um número.")


# ========= FUNÇÕES DE CALCULO =========
def calcular_km_por_litro():
    km = float_positivo("Km rodados: ")
    litros = float_positivo("Litros usados: ")
    return km / litros


def calcular_preco_km():
    km_l = float_positivo("Consumo do carro (km/l): ")
    preco = float_positivo("Preço do litro: ")
    return preco / km_l


def calcular_autonomia():
    km_l = float_positivo("Consumo do carro (km/l): ")
    litros = float_positivo("Litros abastecidos: ")
    return km_l * litros


def calcular_velocidade_media():
    distancia = float_positivo("Distância (km): ")
    tempo = float_positivo("Tempo (min): ") / 60
    return distancia / tempo 


# ========= MENU DE FUNÇÕES =========
while True:
    limpar_tela()

    print("""
===== SISTEMA DE BORDO =====

1. Consumo (km/l)
2. Custo por km
3. Autonomia
4. Velocidade média
9. Sair
""")
    

# ========= CHAMADA DE FUNÇÕES =========
    opcao = input("Escolha uma opção: ")

    if opcao == '1':
        resultado = calcular_km_por_litro()
        print(f"\nConsumo: {resultado:.2f} km/l")

    elif opcao == '2':
        resultado = calcular_preco_km()
        print(f"\nPreço por km: R$ {resultado:.2f}")

    elif opcao == '3':
        resultado = calcular_autonomia()
        print(f"\nAutonomia: {resultado:.2f} km")

    elif opcao == '4':
        resultado = calcular_velocidade_media()
        print(f"\nVelocidade média: {resultado:.2f} km/h")

    elif opcao == '9':
        print("Encerrando sistema...")
        break

    else:
        print("Opção inválida!")

#======== AÇÂO DE REINICIAR ========        

    input("\nPressione Enter para continuar...")