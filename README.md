## Gerenciador De clientes

Este é um simples projeto de um gerenciador de clientes. Nele, por enquanto, é possível criar, editar, listar os clientes, e visualizar um perfil.
Eu optei por usar Laravel + InertiaJs + VueJs. Essa stack proprociona algumas facilidades na reatividade da aplicação, além de facilitar a construção de SPA.

- Contruí alguns componentes para as visualizações, e rotas para as features necessárias (basicamente o CRUD);
- Utilizei algumas classes de validação personalizadas;
- Criei um Repository para tratar da persistência dos dados na tabela de clientes;
- Como é algo muito simples, por hora, decidi usar um db.sqlite;
- Usei o middleware do Inertia para transferir dados na session;
- Estão nos planos a escrita de testes de integração para todas as features, mas por falta de tempo ainda não estão no repositório;
- Criei métodos no model Client, que tomam ações como por exemplo setar o tipo do cliente pelo documento. Isso evita inserção de dado manual nesse campo, que não é necessária;
- Quando criamos um cliente ele tem um avatar padrão definido que pode ser modificado na página de edição do cliente;
- As imagens são salvas em `/public/img/clients/`, e a referência para essa imagem é salva no banco, no campo `image` do cliente;
- Por hora, isto é tudo. Pretendo continuar alimentando esse repositório, e incluir várias features como mensageria, quando tiver um pouco mais de tempo para melhorá-lo.

## Caso queira baixar o projeto, você só precisa seguir esses passos:

### Se estiver usando um sistema linux nativo ou WSL2 no Windowns:
#### IMPORTANTE: Você deve ter o Docker e o Node + NPM instalados!

- 1 - Clone o repositório:
  
  ```
  git clone git@github.com:DevAlysonh/gerenciador-clientes.git
- 2 - Dê permissão de execução para o arquivo `setup_project.sh`:
  
  ```
  chmod +x setup_project.sh
- Pronto, esse script sh deve se encarregar de fazer todo o build e configurações necessárias para que o sistema funcione no seu ambiente local.

### Se estiver usando Windows:
#### IMPORTANTE: Você deve ter o Docker e o Node + NPM instalados!

- 1 - Você precisa apenas acessar a pasta onde clonou o repositório, e executar o arquivo `setup_project.bat`, lembre-se de executar como administrador:
- Pronto, esse executável deve se encarregar de fazer todo o build e configurações necessárias para que o sistema funcione no seu ambiente local.
