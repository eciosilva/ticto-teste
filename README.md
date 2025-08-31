# TICTO - Avaliação para a vaga de Desenvolvedor Back-end Sênior

Candidato: Écio Silva (eciobond@gmail.com)
Linkedin: [https://www.linkedin.com/in/eciosilva/](https://www.linkedin.com/in/eciosilva/ "LinkedIn")

## Instruções para instalação/execução do projeto

1. Faça o checkout do projeto na pasta de sua preferência;

2. Em seguida, crie um arquivo .env a partir do .env.example;

3. Com o Docker previamente instalado, execute o seguinte comando via terminal:

```
docker compose up -d --build
```

4. Acesse o container da aplicação (ticto-app) e, a fim de criar os primeiros Usuários do sistema, execute o Seeder através do comando:

```
php artisan db:seed
```

5. Abra o navegador e acesse a URL `http://localhost:8099` (lembre-se de ajustar a porta, caso tenha alterado o docker-compose.yaml)

## Autenticação

* Para acessar o sistema como **Administrador**, utilizando o registro criado pelo seeder (Passo 4), utilize as seguintes credenciais:

    E-mail: admin@ticto.com.br
	Senha: 12345678

* Para acessar o sistema como **Funcionário**, utilizando o registro criado pelo seeder (Passo 4), utilize as seguintes credenciais:

    E-mail: employee@ticto.com.br
	Senha: 12345678

## Troubleshooting

### Erro de mapeamento de portas

Caso as portas definidas para o servidor web (**NGINX**) e/ou para o SGBD (**MySQL**) já estejam em uso, o Docker não vai conseguir subir os containers, e será necessário alterar o mapeamento através do arquivo **docker.compose.yaml**.

### fatal: detected dubious ownership in repository at '/var/www'

Este erro pode ocorrer pela divergência entre os usuários da máquina hospedeira e do container. Para corrigir, execute o seguinte comando:

```
git config –global –add safe.directory /var/www
```
