
# Desafio 1: Programa de Descontos
#   Implemente um programa que leia o valor total da compra (um número inteiro representando reais) e, usando estruturas condicionais, imprima uma das seguintes mensagens:
#   Se o valor for menor que 50, imprima "Obrigado por comprar conosco!"
#   Se o valor for de 50 a 99 (inclusive), imprima "Parabens! Voce ganhou um brinde!"
#   Se o valor for de 100 a 199 (inclusive), imprima "Desconto de 10 reais aplicado!"
#   Se o valor for 200 ou mais, imprima "Desconto de 25 reais aplicado!"

valor_compra = int(input())

if valor_compra <= 49: 
  print("Obrigado por comprar conosco!")
  
  
elif 50 <= valor_compra <= 99: 
  print("Parabens! Voce ganhou um brinde!")
  
elif 100 <= valor_compra <= 199:
  print("Desconto de 10 reais aplicado!")
  
else:
  print("Desconto de 25 reais aplicado!")


# Desafio 2: Aprovação de Transação
#    Implemente um programa que leia três números inteiros: 
#    o valor da transação, a taxa de serviço e o pagamento mínimo. 
#    Calcule o valor final da transação subtraindo a taxa do valor. 
#    Se o valor final for maior ou igual ao pagamento mínimo, imprima "Aprovada". 
#    Caso contrário, imprima "Recusada".

entrada = input()
valor_transacao, taxa_servico, pagamento_minimo = map(int, entrada.split())

valor_final = valor_transacao - taxa_servico 

if valor_final >= pagamento_minimo:
    print("Aprovada")
else:
    print("Recusada")

# Desafio 3:
#    Implemente um programa que receba uma string representando o nome de um cliente, 
#    possivelmente com letras em qualquer caixa e espaços extras no início ou no fim. 
#    O programa deve retornar o nome formatado corretamente, 
#    com apenas um espaço entre as palavras e cada palavra iniciando com letra maiúscula.
 
entrada = input()


pacote = entrada.strip().split()

palavras_formatadas = [pacote.capitalize() for pacote in pacote]

nome_formatado = ' '.join(palavras_formatadas)

print(nome_formatado) 



