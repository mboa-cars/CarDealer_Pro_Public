#!/bin/bash

echo "🚀 Génération des diagrammes UML pour CarDealer Pro..."

# Vérifier si PlantUML est installé
if ! command -v plantuml &> /dev/null; then
    echo "❌ PlantUML n'est pas installé. Installation..."
    
    # Installation de Java (requis pour PlantUML)
    sudo apt update
    sudo apt install -y default-jre
    
    # Téléchargement et installation de PlantUML
    wget https://github.com/plantuml/plantuml/releases/download/v1.2023.10/plantuml-1.2023.10.jar -O plantuml.jar
    sudo mv plantuml.jar /usr/local/bin/
    echo '#!/bin/bash' | sudo tee /usr/local/bin/plantuml
    echo 'java -jar /usr/local/bin/plantuml.jar "$@"' | sudo tee -a /usr/local/bin/plantuml
    sudo chmod +x /usr/local/bin/plantuml
    
    echo "✅ PlantUML installé avec succès!"
fi

# Créer le dossier pour les images
mkdir -p diagrams

echo "📊 Génération du diagramme de classe..."
plantuml -tpng diagramme_classe.puml -o diagrams/

echo "🔄 Génération du diagramme de séquence..."
plantuml -tpng diagramme_sequence.puml -o diagrams/

echo "🏗️ Génération du diagramme d'architecture..."
plantuml -tpng diagramme_architecture.puml -o diagrams/

echo "✅ Tous les diagrammes ont été générés dans le dossier 'diagrams/'"
echo ""
echo "📁 Fichiers générés :"
ls -la diagrams/
echo ""
echo "🎯 Diagrammes disponibles :"
echo "  - diagrams/CarDealer_Pro_Class_Diagram.png (Diagramme de classe)"
echo "  - diagrams/CarDealer_Pro_Sequence_Diagram.png (Diagramme de séquence)"
echo "  - diagrams/CarDealer_Pro_Architecture.png (Diagramme d'architecture)" 