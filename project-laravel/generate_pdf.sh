#!/bin/bash

# Script pour générer le PDF de la documentation UML
echo "🚀 Génération du PDF de documentation UML..."

# Vérifier si wkhtmltopdf est installé
if ! command -v wkhtmltopdf &> /dev/null; then
    echo "❌ wkhtmltopdf n'est pas installé. Installation en cours..."
    sudo apt-get update
    sudo apt-get install -y wkhtmltopdf
fi

# Générer le PDF
echo "📄 Conversion HTML vers PDF..."
wkhtmltopdf \
    --page-size A4 \
    --margin-top 20 \
    --margin-bottom 20 \
    --margin-left 20 \
    --margin-right 20 \
    --header-center "Documentation UML - Mboa Cars" \
    --header-font-size 10 \
    --footer-center "Page [page] sur [topage]" \
    --footer-font-size 8 \
    --enable-local-file-access \
    documentation_uml.html \
    documentation_uml.pdf

if [ $? -eq 0 ]; then
    echo "✅ PDF généré avec succès : documentation_uml.pdf"
    echo "📁 Fichier créé dans : $(pwd)/documentation_uml.pdf"
else
    echo "❌ Erreur lors de la génération du PDF"
    exit 1
fi 