#!/usr/bin/env bash
# Deploy do tema locutora para produção (Hostinger).
# Só toca wp-content/themes/locutora/ — nunca altera:
#   .htaccess, wp-config.php, plugins da Hostinger, wp-content/uploads, WP core.
set -euo pipefail

SSH_HOST="u562534023@212.85.6.27"
SSH_PORT="65002"
REMOTE_THEME="/home/u562534023/domains/magenta-magpie-160424.hostingersite.com/public_html/wp-content/themes/locutora/"
LOCAL_THEME="$(dirname "$0")/wp-content/themes/locutora/"

EXCLUDE=(
  --exclude='*.png'
  --exclude='*.jpg'
  --exclude='*.jpeg'
  --exclude='*.gif'
  --exclude='*.mp4'
  --exclude='*.woff'
  --exclude='*.woff2'
  --exclude='*.ttf'
  --exclude='*.eot'
  --exclude='*.svg'
  --exclude='.DS_Store'
  --exclude='*.md'
)

echo "==> Arquivos que serão alterados em produção (dry-run):"
rsync -n -avz --checksum --no-delete "${EXCLUDE[@]}" \
  -e "ssh -p $SSH_PORT" \
  "$LOCAL_THEME" \
  "$SSH_HOST:$REMOTE_THEME"

echo ""
echo "Escopo do deploy: SOMENTE wp-content/themes/locutora/"
echo "Nenhum arquivo fora do tema será tocado."
echo ""
read -r -p "Confirmar deploy para produção? [s/N] " REPLY
if [[ ! "$REPLY" =~ ^[Ss]$ ]]; then
  echo "Deploy cancelado."
  exit 0
fi

echo ""
echo "==> Enviando arquivos..."
rsync -avz --checksum --no-delete "${EXCLUDE[@]}" \
  -e "ssh -p $SSH_PORT" \
  "$LOCAL_THEME" \
  "$SSH_HOST:$REMOTE_THEME"

echo ""
echo "==> Deploy concluído. Nenhum arquivo da Hostinger foi alterado."
