#manipulação de maiúscula, minúscula e título.
curso = "  pYtHoN  "

print(curso.upper())#deixa tudo em caixa alta
print(curso.lower())#deixa tudo em caixa baixa
print(curso.title())#formata com apenas a inicial maiúscula


#manipulação de espaçõs vazios.
print(curso.strip())#remove os espaços(l/r)
print(curso.lstrip())#remove o espaço a esquerda
print(curso.rstrip() + "!")#remove o espaço a direta e adiciona !


#junções e centralização

curso = "Py"

print(curso.center(10, "#"))#centraliza a string e prenche o restante(de 10) com "#"
print("#".join(curso))#insere "#" entre os algarimos da string


###Método format####

nome = "Ferrari"
idade = 76
profissao = "F1"
nacionalidade = "italiana"

print("Somos a equipe {}, de {}. Temos cerca de {} anos de historia na categoria e somos de origem {}.".format(nome, profissao, idade, nacionalidade))# as variaveis vão ser preenchidas de a cordo com a ordem do .format()
print("Somos a equipe {0}, de {1}. Temos cerca de {2} anos de historia na categoria e somos de origem {variavel4}.".format(nome, profissao, idade, variavel4 = nacionalidade))# as variaveis foram preenchidas de a coordo com o numero na {}

#### f-string #### 

print(f"Somos a equipe {nome} de {profissao}. temos {idade}anos de idade e nacionalidade {nacionalidade} ")#talvez o melhor metodo.

#formatar uma f-string
pi = 3.14159
print(f"o valor de pi é {pi:.2f}")# o .2f retia os valores apos duas casas além do . a direta
print(f"o valor de pi é {pi:10.2f}")# faz a mesma coisa mas adiciona 10 espaços vazios 





