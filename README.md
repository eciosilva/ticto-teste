# TICTO - Avaliação para a vaga de Desenvolvedor Back-end Sênior

Candidato: Écio Silva

## Instruções para instalação/execução do projeto

Com o Docker previamente instalado, rodar o seguinte comando via terminal:

```
docker compose up -d --build
```

Acessar o container da aplicação (ticto-app) e, a fim de criar o Administrador do sistema, executar o Seeder através do comando:

```
php artisan db:seed --class=UserSeeder
```


## Troubleshooting

### Erro de mapeamento de portas

Caso as portas mapeadas já estejam em uso, o Docker não vai conseguir subir os containers, e será necessário alterar o mapeamento através do arquivo **docker.compose.yaml**.

### fatal: detected dubious ownership in repository at '/var/www'

Este erro pode ocorrer pela divergência entre os usuários da máquina hospedeira e do container. Para corrigir, execute o seguinte comando:

```
git config –global –add safe.directory /var/www
```
