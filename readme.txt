comando para escucha de tailwind: npx tailwindcss -i ./input.css -o ./assets/styles.css --watch
version de node: v20.11.0

modificar en node_modules en la ruta para mnostrar los iconos:
remixicon/fonts/remixicon.css -> se añade ../node_modules/remixicon/fonts/ a cada archivo para que al generar reconozca los iconos con tailwind 
  src: url('../node_modules/remixicon/fonts/remixicon.eot?t=1730118419915'); /* IE9*/
  src: url('../node_modules/remixicon/fonts/remixicon.eot?t=1730118419915#iefix') format('embedded-opentype'), /* IE6-IE8 */
  url("../node_modules/remixicon/fonts/remixicon.woff2?t=1730118419915") format("woff2"),
  url("../node_modules/remixicon/fonts/remixicon.woff?t=1730118419915") format("woff"),
  url('../node_modules/remixicon/fonts/remixicon.ttf?t=1730118419915') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
  url('../node_modules/remixicon/fonts/remixicon.svg?t=1730118419915#remixicon') format('svg'); /* iOS 4.1- */