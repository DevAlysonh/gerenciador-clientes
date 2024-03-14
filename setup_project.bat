@echo off

REM Verifica se o Docker está instalado
where docker >nul 2>nul
if %errorlevel% neq 0 (
    echo Docker não encontrado. Por favor, instale o Docker para continuar.
    exit /b 1
)

REM Verifica se o Docker Compose está instalado
where docker-compose >nul 2>nul
if %errorlevel% neq 0 (
    echo Docker Compose não encontrado. Por favor, instale o Docker Compose para continuar.
    exit /b 1
)

REM Cria o arquivo do banco SQLite
type nul >.\database\database.sqlite

REM Obtém o caminho absoluto do arquivo
for %%I in (.\database\database.sqlite) do set "absolut_path=%%~fI"

REM Copia o env.example para .env
copy .env.example .env

REM Adiciona as linhas ao arquivo .env
echo DB_CONNECTION=sqlite >> .env
echo DB_HOST=%absolut_path% >> .env

REM Inicia os contêineres
docker-compose up -d

REM Instala as dependências PHP
docker-compose exec -it app composer install

REM Executa as migrations
docker-compose exec -it app php artisan migrate

REM Dá permissões aos diretórios
icacls database /grant Everyone:(OI)(CI)F >nul 2>nul
icacls storage /grant Everyone:(OI)(CI)F >nul 2>nul
icacls public /grant Everyone:(OI)(CI)F >nul 2>nul

REM Instala as dependências Node.js e compila os assets
npm install && npm run dev

REM Fim do script
exit /b 0