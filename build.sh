#!/bin/bash

# YouTube Shortcode Plugin - Build Script
# Script para empaquetar el plugin de WordPress en un archivo ZIP

set -e  # Exit on error

# Obtener información del plugin
PLUGIN_NAME="youtube-shortcode-lb"
PLUGIN_FILE="youtube-shortcode-lb.php"
VERSION=$(grep "Version:" "$PLUGIN_FILE" | head -1 | cut -d':' -f2 | tr -d ' ')
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
OUTPUT_FILE="${PLUGIN_NAME}.${VERSION}.zip"
BACKUP_FILE="${PLUGIN_NAME}.${VERSION}.${TIMESTAMP}.backup.zip"

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}════════════════════════════════════════════${NC}"
echo -e "${BLUE}  YouTube Shortcode Plugin - Build Script${NC}"
echo -e "${BLUE}════════════════════════════════════════════${NC}"
echo ""
echo -e "${GREEN}Plugin:${NC} $PLUGIN_NAME"
echo -e "${GREEN}Versión:${NC} $VERSION"
echo -e "${GREEN}Archivo de salida:${NC} $OUTPUT_FILE"
echo ""

# Validar que estamos en el directorio correcto
if [ ! -f "$PLUGIN_FILE" ]; then
    echo -e "${RED}❌ Error: No se encontró $PLUGIN_FILE${NC}"
    echo "Asegúrate de ejecutar este script desde la raíz del plugin."
    exit 1
fi

# Crear directorio temporal
TEMP_DIR="temp_build_$$"
PLUGIN_DIR="$TEMP_DIR/$PLUGIN_NAME"
mkdir -p "$PLUGIN_DIR"

echo -e "${YELLOW}📁 Creando estructura temporal...${NC}"

# Lista de archivos y directorios a incluir
FILES_TO_INCLUDE=(
    "youtube-shortcode-lb.php"
    "youtube-shortcode-lb.css"
    "README.md"
    "readme.txt"
    "CHANGELOG.md"
    "CONTRIBUTING.md"
    "DEVELOPMENT.md"
    "WOOCOMMERCE.md"
    "LICENSE"
    "languages"
)

# Copiar archivos necesarios
echo -e "${YELLOW}📝 Copiando archivos del plugin...${NC}"
for item in "${FILES_TO_INCLUDE[@]}"; do
    if [ -e "$item" ]; then
        cp -r "$item" "$PLUGIN_DIR/"
        echo -e "${GREEN}  ✓${NC} $item"
    else
        echo -e "${YELLOW}  ⚠${NC} No encontrado: $item"
    fi
done

# Crear archivo ZIP
echo ""
echo -e "${YELLOW}🗜️  Creando archivo ZIP...${NC}"

# Si el archivo ya existe, crear backup
if [ -f "$OUTPUT_FILE" ]; then
    echo -e "${YELLOW}  Creando backup del archivo anterior...${NC}"
    mv "$OUTPUT_FILE" "$BACKUP_FILE"
    echo -e "${GREEN}  ✓${NC} Backup: $BACKUP_FILE"
fi

# Crear el ZIP
cd "$TEMP_DIR"
zip -r "../$OUTPUT_FILE" "$PLUGIN_NAME" -q
cd ..

# Verificar que el ZIP se creó correctamente
if [ ! -f "$OUTPUT_FILE" ]; then
    echo -e "${RED}❌ Error: No se pudo crear el archivo ZIP${NC}"
    rm -rf "$TEMP_DIR"
    exit 1
fi

# Limpiar directorio temporal
echo -e "${YELLOW}🧹 Limpiando archivos temporales...${NC}"
rm -rf "$TEMP_DIR"

# Mostrar información final
echo ""
echo -e "${GREEN}════════════════════════════════════════════${NC}"
echo -e "${GREEN}✅ ¡Plugin empaquetado exitosamente!${NC}"
echo -e "${GREEN}════════════════════════════════════════════${NC}"
echo ""
echo -e "${BLUE}📦 Información del archivo:${NC}"
echo "   Nombre: $OUTPUT_FILE"
SIZE=$(du -h "$OUTPUT_FILE" | cut -f1)
echo "   Tamaño: $SIZE"
LINES=$(unzip -l "$OUTPUT_FILE" | tail -1 | awk '{print $2}')
echo "   Archivos empaquetados: $LINES"
echo ""

# Verificar integridad del ZIP
echo -e "${YELLOW}🔍 Verificando integridad del ZIP...${NC}"
if unzip -t "$OUTPUT_FILE" > /dev/null 2>&1; then
    echo -e "${GREEN}  ✓ ZIP verificado correctamente${NC}"
else
    echo -e "${RED}  ✗ Error en la verificación del ZIP${NC}"
    exit 1
fi

echo ""
echo -e "${BLUE}💡 Próximos pasos:${NC}"
echo "   1. Sube el archivo $OUTPUT_FILE a tu servidor"
echo "   2. O carga el archivo desde Plugins → Agregar nuevo → Subir"
echo ""

exit 0
 