#!/usr/bin/env bash
# Deploy do tema locutora para produção (Hostinger).
# Só toca wp-content/themes/locutora/ — nunca altera:
#   .htaccess, wp-config.php, plugins da Hostinger, wp-content/uploads, WP core.
set -euo pipefail

SSH_HOST="u562534023@212.85.6.27"
SSH_PORT="65002"
REMOTE_BASE="u562534023@212.85.6.27:/home/u562534023/domains/magenta-magpie-160424.hostingersite.com/public_html/wp-content/themes/locutora"
LOCAL_THEME="$(dirname "$0")/wp-content/themes/locutora"

# Arquivos de código que fazem parte do tema
FILES=(
  style.css
  functions.php
  index.php
  header.php
  footer.php
  page.php
  front-page.php
  page-sobre-nos.php
  page-servicos.php
  page-contato.php
  assets/js/site.js
)

echo "==> Arquivos que serão enviados:"
for f in "${FILES[@]}"; do
  if [[ -f "$LOCAL_THEME/$f" ]]; then
    echo "    $f"
  fi
done

echo ""
echo "Escopo: SOMENTE wp-content/themes/locutora/ — nada fora do tema é tocado."
echo ""
read -r -p "Confirmar deploy para produção? [s/N] " REPLY
if [[ ! "$REPLY" =~ ^[Ss]$ ]]; then
  echo "Deploy cancelado."
  exit 0
fi

echo ""
echo "==> Enviando arquivos..."
for f in "${FILES[@]}"; do
  local_file="$LOCAL_THEME/$f"
  if [[ -f "$local_file" ]]; then
    scp -P "$SSH_PORT" "$local_file" "$REMOTE_BASE/$f" && echo "  ✓ $f"
  fi
done

echo ""
echo "==> Limpando cache do servidor..."
ssh -p "$SSH_PORT" "$SSH_HOST" \
  "cd /home/u562534023/domains/magenta-magpie-160424.hostingersite.com/public_html && wp litespeed-purge all --allow-root 2>/dev/null || true"

echo ""
echo "==> Deploy concluído."
