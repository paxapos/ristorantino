# Make sure only root can run our script
if [ "$(id -u)" != "0" ]; then
   echo "Debes ser root para correr este script" 1>&2
   exit 1
fi
# ...

MY_PATH="`dirname \"$0\"`"              # relative
MY_PATH="`( cd \"$MY_PATH\" && pwd )`"  # absolutized and normalized
if [ -z "$MY_PATH" ] ; then
  # error; for some reason, the path is not accessible
  # to the script (e.g. permissions re-evaled after suid)
  exit 1  # fail
fi

cp spooler /usr/bin
cp hasar_spooler.sh /usr/bin
cp spooler_srv /etc/init.d
cp printServer.py /etc/init.d
update-rc spooler_srv defaults
update-rc printServer.py defaults


echo "LISTO! deberás reiniciar para que funcione"