#1 Fazer um codigo que consiga diferenciar um numero par de um ímpar 

numero = int(input())

if numero % 2 == 0:
   print("Par")
else:
   print("Ímpar")
   



#2 Identificador de ano bisexto

def verificador_ano_bissexto():
    ano = int(input())

    if (ano % 4 == 0 and ano % 100 != 0) or ano % 400 == 0:
        print("SIM")
    else:
        print("NÃO")

verificador_ano_bissexto()




#3 contador de vogais

def conta_vogais(texto):
    
    vogais = "aeiouAEIOU"
    
    contador = 0 
    
   
    for char in texto:
       
        if char in vogais:
           contador += 1 
    return contador


texto = input()


resultado = conta_vogais(texto)
print(f"O número de vogais na frase '{texto}' é: {resultado}")

