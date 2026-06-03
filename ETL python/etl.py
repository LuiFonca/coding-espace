import pandas as pd
import os


print("Diretório atual:", os.getcwd())
print("Arquivo existe?", os.path.exists("./dados/olist_customers_dataset.csv"))
def tratar_dataframe(df):
    # Remover linhas totalmente duplicadas
    df = df.drop_duplicates()
    
    # Processar colunas de texto
    for col in df.columns:
        # Verificar se a coluna é do tipo texto
        if pd.api.types.is_string_dtype(df[col]):
            # Remover espaços em branco no início e no fim
            df[col] = df[col].str.strip()
            # Substituir múltiplos espaços internos por um único espaço
            df[col] = df[col].str.replace(r'\s+', ' ', regex=True)
            # Substituir strings vazias e com apenas espaços por NaN
            df[col] = df[col].replace({'': pd.NA, ' ': pd.NA})
    
    # Processar colunas numéricas
    for col in df.columns:
        # Verificar se a coluna é do tipo float
        if pd.api.types.is_float_dtype(df[col]):
            # Arredondar valores monetários para 2 casas decimais
            df[col] = df[col].round(2)
            # Converter para inteiro se todos os valores forem inteiros e não houver NaN
            if df[col].isnull().sum() == 0 and (df[col].astype(int) == df[col]).all():
                df[col] = df[col].astype(int)
    
    # Remover espaços em branco dos nomes das colunas
    df.columns = [col.replace(' ', '_') for col in df.columns]
    
    return df

# Diretório de entrada e saída
input_dir = './dados'
output_dir = './dados_tratados'

# Criar diretório de saída se não existir
os.makedirs(output_dir, exist_ok=True)

# Lista de arquivos
files = [
    'olist_customers_dataset.csv',
    'olist_orders_dataset.csv',
    'olist_products_dataset.csv',
    'olist_sellers_dataset.csv',
    'product_category_name_translation.csv'
]

for file in files:
    file_path = os.path.join(input_dir, file)
    output_path = os.path.join(output_dir, file)
    
    try:
        # Tentar ler com encoding 'utf-8'
        df = pd.read_csv(file_path, encoding='utf-8')
    except UnicodeDecodeError:
        # Se falhar, tentar com 'latin-1'
        df = pd.read_csv(file_path, encoding='latin-1')
    
    # Tratar os dados
    df_tratado = tratar_dataframe(df)
    
    # Salvar o DataFrame tratado
    df_tratado.to_csv(output_path, index=False, encoding='utf-8')
    
    # Calcular estatísticas
    rows_before = len(df)
    rows_after = len(df_tratado)
    duplicates_removed = rows_before - rows_after
    
    print(f"Arquivo: {file}")
    print(f"Linhas antes do tratamento: {rows_before}")
    print(f"Linhas após o tratamento: {rows_after}")
    print(f"Linhas duplicadas removidas: {duplicates_removed}")
    print("-" * 40)
