saldo = float(input('Qual o seu saldo:'))
saque = float(print("Qual o valor do saque desejado:"))

if saldo == saque:
    print("Saque aceito, sem valores restantes em conta.")
elif saldo > saque:
    print("Saque aceito, ainda com valores em conta.")
else:
    print("Saque recusado, saldo insuficiente.")


    # condicional != serve para ver se são diferentes, seria o oposto de ==
      
      