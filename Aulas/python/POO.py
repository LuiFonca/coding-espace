class bicicleta:
    def __init__( self, cor , modelo, ano, valor):
        self.cor = cor
        self.modelo = modelo 
        self.ano = ano
        self.valor = valor
     
    
bk1 = bicicleta("cinza", "sense", 2024, "2500 reais")

print( bk1.cor, bk1.modelo, bk1.ano)