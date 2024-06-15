source config.sh

echo "$resetGit"

if [ $resetGit -eq 1 ];
then
    git restore .
    git pull
fi

./extractBodyBulk.sh
