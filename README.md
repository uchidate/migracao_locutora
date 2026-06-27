# Migração Locutora

Este projeto está preparado para criar uma cópia de `locutora.com` usando WordPress, com um tema customizado no diretório `wp-content/themes/locutora`.

## O que foi criado

- `docker-compose.yml` - ambiente local WordPress + MariaDB para desenvolvimento da cópia.
- `wp-content/themes/locutora` - tema WordPress customizado com estrutura de homepage, menu e seções principais.

## Como usar localmente

1. Instale Docker no seu Mac, se ainda não tiver.
2. No diretório do projeto, rode:
   ```bash
   docker compose up -d
   ```
3. Abra `http://localhost:8000` e siga o instalador do WordPress.
4. Faça login no painel WordPress e ative o tema `Locutora` em Aparência > Temas.

## Como publicar no Hostinger (hospedagem compartilhada)

Hostinger compartilhado não roda Docker; ele suporta WordPress tradicional com PHP + MySQL.

1. No Hostinger, crie uma conta de hospedagem WordPress ou instale o WordPress manualmente.
2. Use PHP 8.0/8.1/8.2 e banco MySQL/MariaDB.
3. Faça upload do tema `wp-content/themes/locutora` para a pasta `wp-content/themes/` do WordPress no Hostinger, usando FTP/SFTP ou o Gerenciador de Arquivos.
4. No painel WordPress do Hostinger, vá em Aparência > Temas e ative o tema `Locutora`.
5. Crie as páginas `Sobre nós`, `Áudios` e `Contato`, e cada uma use o template correspondente do tema.
6. Em Configurações > Leitura, configure a página inicial como estática e selecione a homepage desejada.

### Tecnologias compatíveis com Hostinger compartilhado

- PHP 8.x
- MySQL / MariaDB
- WordPress Core
- Temas e plugins WordPress
- `.htaccess`
- FTP / SFTP / Gerenciador de Arquivos

## Próximos passos

- Ajustar imagens e conteúdo reais de locutora.com.
- Configurar menu e páginas `Sobre nós`, `Áudios`, `Contato` no WordPress.
- Adicionar widgets e formulário de contato via plugin Hostinger/WordPress.
