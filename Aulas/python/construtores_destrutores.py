class bicicleta:
    def __init__(self, modelo, cor , ano, estoque = True ):

        self.modelo = modelo
        self.cor = cor
        self.ano = ano
        self.estoque = estoque

   

    
    def disponivel_venda(self):
        if self.estoque:
            print('A bicicleta está disponivel para venda.') 
        else:
            print('bicicleta indisponivel')

    def descricao_bicicleta(self):
        print(f'o modelo da bicicleta é {self.modelo} do ano de {self.ano} na cor {self.cor}')      

bk1 = bicicleta("sense", "cinza", 2024)
bk1.descricao_bicicleta()
bk1.disponivel_venda()
bk2 = bicicleta("GT", "branca", 2012, estoque=False)
bk2.descricao_bicicleta()
bk2.disponivel_venda()