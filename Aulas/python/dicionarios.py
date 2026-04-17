

carro = { 
    "modelo" : " golf ",
    "motor"  : " TSI 2.0 ",
    "potencia": " 230cv ",
    "velocidade": {"aceleracao":"5.5seg", "velocidade_maxima":"270km/h"}
  }

carro["cor"] = "branco" #adiciona o valor ao final do dicionario
 
 


print(f"{carro}")
print(f"{carro["velocidade"]["aceleracao"]}")#selecionar valores especificos [nv1][nv2][nv3]...


automovel = carro.copy()#copia o dicionario sem alterar o valor do original 
automovel.clear()#limpa os dados
print(f"###Teste 2###{carro}")
print(f"###Teste 2###{automovel}")