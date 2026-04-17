#Desenvolva uma função em Python que recebe uma tupla de números inteiros e retorna a soma de todos os elementos dessa tupla. 
# A função deve ser capaz de lidar com tuplas de qualquer tamanho, contanto que todos os elementos sejam números inteiros. 
# O objetivo é praticar a manipulação de tuplas e a utilização de funções em Python.

def soma_tupla(tupla):
    return sum(tupla)
  

if __name__ == "__main__":
    entrada = input()



    elementos = tuple(map(int, entrada.split()))
    
    resultado = soma_tupla(elementos)
    print(f"A soma dos elementos da tupla é: {resultado}")









# Desenvolva uma função que receba duas listas de números inteiros
#  separados por espaço e retorne uma lista contendo apenas os elementos que são comuns a ambas as listas, sem duplicatas.
def elementos_comuns(lista1,lista2):
  lista1 = list(map(int, lista1))
  lista2 = list(map(int, lista2))
  
  set1 = set(lista1)
  set2 = set(lista2)

  return list(set1.intersection(set2))

# Leitura das listas
lista1 = input().split()
lista2 = input().split()

# Verifica se todas os elementos das listas podem ser convertidos para inteiros
if all(item.isdigit() for item in lista1) and all(item.isdigit() for item in lista2):
    comuns = elementos_comuns(lista1, lista2)
    print(f"Elementos comuns às duas listas: {comuns}")
else:
    print("Entrada inválida.")










#O desafio consiste em adicionar à função contar_caracteres um dicionário vazio chamado contador para armazenar as contagens de caracteres.
#Vamos iterar através de cada caractere na string string. Para cada caractere, verifique se ele já está presente no dicionário contador.
#Se estiver, incremente o valor associado a essa chave. Caso contrário, adicione a chave ao dicionário com valor inicial 1. 
#Neste dicionário, as chaves são os caracteres presentes na string e os valores correspondem à contagem de vezes que cada caractere aparece.
def contar_caracteres(string):
#Inicialize um dicionário vazio 'contador' para armazenar as contagens de caracteres.:
  contador = {
    
  }  
#Itere através de cada caractere na string string.
  for letra in string:
#Para cada caractere, verifique se ele já está presente no dicionário contador:
    if letra in contador:
      contador[letra] += 1 
    else:
      contador[letra] = 1
      
    
  return contador

# Solicita entrada do usuário
entrada = input()
resultado = contar_caracteres(entrada)
print(resultado)    