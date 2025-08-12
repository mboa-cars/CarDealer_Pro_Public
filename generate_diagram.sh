#!/bin/bash

# Script pour générer le diagramme de classe
echo "Génération du diagramme de classe..."

# Vérifier si PlantUML est installé
if ! command -v plantuml &> /dev/null; then
    echo "PlantUML n'est pas installé. Installation en cours..."
    
    # Vérifier si Java est installé
    if ! command -v java &> /dev/null; then
        echo "Java est requis pour PlantUML. Installation de Java..."
        sudo apt-get update
        sudo apt-get install -y openjdk-11-jre
    fi
    
    # Télécharger et installer PlantUML
    wget https://github.com/plantuml/plantuml/releases/download/v1.2023.10/plantuml-1.2023.10.jar -O plantuml.jar
    echo '#!/bin/bash' > plantuml
    echo 'java -jar plantuml.jar "$@"' >> plantuml
    chmod +x plantuml
    sudo mv plantuml /usr/local/bin/
    sudo mv plantuml.jar /usr/local/bin/
fi

# Générer le diagramme
echo "Génération du diagramme de classe..."
plantuml diagramme_classe.puml

if [ $? -eq 0 ]; then
    echo "✅ Diagramme de classe généré avec succès !"
    echo "📁 Fichier créé : diagramme_classe.png"
else
    echo "❌ Erreur lors de la génération du diagramme"
fi 