#!/bin/bash

HOME_DIR = `/home/pituser/`
HTML_DIR = `public_html/`
TMP_DIR = `files/`

if [ -e ${HOME_DIR}${HTML_DIR}${TMP_DIR} ]
then
	echo "tmp dir already exists."
    exit 0
else

	git clone https://github.com/yusukeasari/LivePITPackage.git ${HOME_DIR}${HTML_DIR}${TMP_DIR}
	git clone https://github.com/yusukeasari/Johoo.git ${HOME_DIR}${HTML_DIR}${TMP_DIR}

	mv "${HOME_DIR}${HTML_DIR}${TMP_DIR}*" ${HOME_DIR}${HTML_DIR}

	rm -rf ${HOME_DIR}${HTML_DIR}${TMP_DIR}


#
echo -n "サブドメインを入力："
read INPUT
sed -i -e "s/DOMAIN/$INPUT/g" setup2016.json.txt
sed -i -e "s/DOMAIN/$INPUT/g" app/mid.json

echo -n "縦ブロック数："
read INPUT
sed -i -e "s/0000/$INPUT/g" setup2016.json.txt
sed -i -e "s/0000/$INPUT/g" app/mid.json

echo -n "縦ブロック数："
read INPUT
sed -i -e "s/0000/INPUT/g" setup2016.json.txt
sed -i -e "s/0000/INPUT/g" app/mid.json