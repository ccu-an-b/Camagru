echo "Creating symb link for:"
echo ${PWD}

ln -s ${PWD} "/Users/ccu-an-b/MAMP/apache2/htdocs"

echo "Opening localhost"
open "http://localhost:8080"
