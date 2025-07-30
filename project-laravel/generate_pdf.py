#!/usr/bin/env python3
"""
Script pour générer le PDF de documentation UML
"""

import os
import sys
from weasyprint import HTML, CSS
from weasyprint.text.fonts import FontConfiguration

def generate_pdf():
    print("🚀 Génération du PDF de documentation UML...")
    
    # Vérifier que le fichier HTML existe
    html_file = "documentation_uml.html"
    if not os.path.exists(html_file):
        print(f"❌ Le fichier {html_file} n'existe pas")
        return False
    
    # CSS personnalisé pour améliorer l'apparence du PDF
    css_content = """
    @page {
        size: A4;
        margin: 2cm;
        @top-center {
            content: "Documentation UML - Mboa Cars";
            font-size: 10pt;
        }
        @bottom-center {
            content: "Page " counter(page) " sur " counter(pages);
            font-size: 8pt;
        }
    }
    
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        color: #333;
    }
    
    h1 {
        color: #F26522;
        text-align: center;
        border-bottom: 3px solid #F26522;
        padding-bottom: 10px;
        margin-bottom: 30px;
        page-break-after: avoid;
    }
    
    h2 {
        color: #333;
        margin-top: 40px;
        margin-bottom: 20px;
        border-left: 4px solid #F26522;
        padding-left: 15px;
        page-break-after: avoid;
    }
    
    .diagram-container {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
        border: 1px solid #dee2e6;
        page-break-inside: avoid;
    }
    
    .description {
        background: #e3f2fd;
        padding: 15px;
        border-radius: 5px;
        margin: 15px 0;
        border-left: 4px solid #2196f3;
    }
    
    .tech-stack {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin: 20px 0;
    }
    
    .tech-item {
        background: #f1f8e9;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        border: 1px solid #c8e6c9;
    }
    
    .features-list {
        background: #fff3e0;
        padding: 20px;
        border-radius: 5px;
        margin: 20px 0;
    }
    
    .features-list ul {
        columns: 2;
        column-gap: 30px;
    }
    
    .features-list li {
        margin-bottom: 8px;
    }
    
    @media print {
        .container {
            max-width: none;
            margin: 0;
            padding: 0;
            box-shadow: none;
        }
    }
    """
    
    try:
        # Configurer les polices
        font_config = FontConfiguration()
        
        # Créer le PDF
        print("📄 Conversion HTML vers PDF...")
        html_doc = HTML(filename=html_file)
        css_doc = CSS(string=css_content, font_config=font_config)
        
        # Générer le PDF
        html_doc.write_pdf(
            "documentation_uml.pdf",
            stylesheets=[css_doc],
            font_config=font_config
        )
        
        print("✅ PDF généré avec succès : documentation_uml.pdf")
        print(f"📁 Fichier créé dans : {os.path.abspath('documentation_uml.pdf')}")
        return True
        
    except Exception as e:
        print(f"❌ Erreur lors de la génération du PDF : {str(e)}")
        return False

if __name__ == "__main__":
    success = generate_pdf()
    sys.exit(0 if success else 1) 