from pathlib import Path
import pandas as pd


# LEITURA DOS CSVs


base = Path("/Users/luizfonseca/Documents/GitHub/coding-espace/ETL python/dados")

tabelas = {
    "Customers": pd.read_csv(base / "olist_customers_dataset.csv"),
    "Geolocation": pd.read_csv(base / "olist_geolocation_dataset.csv"),
    "Order Items": pd.read_csv(base / "olist_order_items_dataset.csv"),
    "Order Payments": pd.read_csv(base / "olist_order_payments_dataset.csv"),
    "Order Reviews": pd.read_csv(base / "olist_order_reviews_dataset.csv"),
    "Orders": pd.read_csv(base / "olist_orders_dataset.csv"),
    "Products": pd.read_csv(base / "olist_products_dataset.csv"),
    "Sellers": pd.read_csv(base / "olist_sellers_dataset.csv")
}


# RELATÓRIO DE QUALIDADE


def analisar_dataframe(nome, df):
    print("\n" + "=" * 70)
    print(f"TABELA: {nome}")
    print("=" * 70)

    print(f"Linhas: {len(df):,}")
    print(f"Colunas: {len(df.columns)}")
    print(f"Duplicados: {df.duplicated().sum():,}")

    nulos = df.isnull().sum()
    nulos = nulos[nulos > 0]

    if len(nulos) > 0:
        print("\nCOLUNAS COM VALORES NULOS:")

        for coluna, qtd in nulos.items():
            percentual = (qtd / len(df)) * 100

            print(
                f"- {coluna}: "
                f"{qtd:,} registros "
                f"({percentual:.2f}%)"
            )
    else:
        print("\nNenhum valor nulo encontrado.")

    print("\nTipos das colunas:")
    print(df.dtypes)


# ANÁLISE DE TODAS AS TABELAS


for nome, df in tabelas.items():
    analisar_dataframe(nome, df)