
# primeira questão do curso
print('Oi, estou aprendendo python.')


primeiro_valor = float(input('Calculadora = Digite o primeiro valor: '))

operacao = input('Qual operação deseja [ + , - , x , / ]: ')

segundo_valor = float(input('Calculadora = Digite o segundo valor: '))

match operacao:
    case '+':
        resultado = primeiro_valor + segundo_valor 
    case '-':
        resultado = primeiro_valor - segundo_valor 
    case 'x':
        resultado = primeiro_valor * segundo_valor 
    case '/':
        resultado = primeiro_valor / segundo_valor 
    case _:
        print('Operação inválida')    


print(f'Resultado da operação: {resultado:g}')